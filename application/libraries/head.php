<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Document head renderer
 *
 * @subpackage  Document
 * @since       11.1
 */
class DocumentRendererHead
{
	/**
	 * Renders the document head and returns the results as a string
	 *
	 * @param   string  $head     (unused)
	 * @param   array   $params   Associative array of values
	 * @param   string  $content  The script
	 *
	 * @return  string  The output of the script
	 *
	 * @since   11.1
	 *
	 * @note    Unused arguments are retained to preserve backward compatibility.
	 */
	/**
	 * Reference to the Document object that instantiated the renderer
	 *
	 * @var    Document
	 * @since  11.1
	 */
	protected $_doc = null;

	public function __construct($doc)
	{
		$this->_doc = $doc;
	}
	public function render($head, $params = array(), $content = null)
	{
		ob_start();
		echo $this->fetchHead($this->_doc);
		$buffer = ob_get_contents();
		ob_end_clean();

		return $buffer;
	}

	/**
	 * Generates the head HTML and return the results as a string
	 *
	 * @param   JDocument  $document  The document for which the head will be created
	 *
	 * @return  string  The head hTML
	 *
	 * @since   11.1
	 */
	public function fetchHead($document)
	{
		// Get line endings
		$lnEnd = $document->_getLineEnd();
		$tab = $document->_getTab();
		$tagEnd = ' />';
		$buffer = '';

		// Generate charset when using HTML5 (should happen first)
		if ($document->isHtml5())
		{
			$buffer .= $tab . '<meta charset="' . $document->getCharset() . '" />' . $lnEnd;
		}

		// Generate base tag (need to happen early)
		$base = $document->getBase();
		if (!empty($base))
		{
			$buffer .= $tab . '<base href="' . $document->getBase() . '" />' . $lnEnd;
		}

		// Generate META tags (needs to happen as early as possible in the head)
		foreach ($document->_metaTags as $type => $tag)
		{
			foreach ($tag as $name => $content)
			{
				if ($type == 'http-equiv' && !($document->isHtml5() && $name == 'content-type'))
				{
					$buffer .= $tab . '<meta http-equiv="' . $name . '" content="' . htmlspecialchars($content) . '" />' . $lnEnd;
				}
				elseif ($type == 'standard' && !empty($content))
				{
					$buffer .= $tab . '<meta name="' . $name . '" content="' . htmlspecialchars($content) . '" />' . $lnEnd;
				}
			}
		}

		// Don't add empty descriptions
		$documentDescription = $document->getDescription();
		if ($documentDescription)
		{
			$buffer .= $tab . '<meta name="description" content="' . htmlspecialchars($documentDescription) . '" />' . $lnEnd;
		}

		// Don't add empty generators
		$generator = $document->getGenerator();
		if ($generator)
		{
			$buffer .= $tab . '<meta name="generator" content="' . htmlspecialchars($generator) . '" />' . $lnEnd;
		}

		$buffer .= $tab . '<title>' . htmlspecialchars($document->getTitle(), ENT_COMPAT, 'UTF-8') . '</title>' . $lnEnd;

		// Generate link declarations
		foreach ($document->_links as $link => $linkAtrr)
		{
			$buffer .= $tab . '<link href="' . $link . '" ' . $linkAtrr['relType'] . '="' . $linkAtrr['relation'] . '"';
			if ($temp = $document->toString($linkAtrr['attribs']))
			{
				$buffer .= ' ' . $temp;
			}
			$buffer .= ' />' . $lnEnd;
		}

		// Generate stylesheet links
        $precss='';
		foreach ($document->_styleSheets as $strSrc => $strAttr)
		{
            if ($strAttr['prefer'])
            {
			    $precss = $tab . '<link rel="stylesheet" href="' . $strSrc . '"';

			    if (!is_null($strAttr['mime']) && (!$document->isHtml5() || $strAttr['mime'] != 'text/css'))
			    {
				    $precss .= ' type="' . $strAttr['mime'] . '"';
			    }

			    if (!is_null($strAttr['media']))
			    {
				    $precss .= ' media="' . $strAttr['media'] . '"';
			    }

			    if ($temp = $document->toString($strAttr['attribs']))
			    {
				    $precss .= ' ' . $temp;
			    }

			    $precss .= $tagEnd . $lnEnd;
            }
            else
            {
                $buffer .= $tab . '<link rel="stylesheet" href="' . $strSrc . '"';

                if (!is_null($strAttr['mime']) && (!$document->isHtml5() || $strAttr['mime'] != 'text/css'))
                {
                    $buffer .= ' type="' . $strAttr['mime'] . '"';
                }

                if (!is_null($strAttr['media']))
                {
                    $buffer .= ' media="' . $strAttr['media'] . '"';
                }

                if ($temp = $document->toString($strAttr['attribs']))
                {
                    $buffer .= ' ' . $temp;
                }

                $buffer .= $tagEnd . $lnEnd;
            }
		}
        $buffer .= $precss;
		// Generate stylesheet declarations
		foreach ($document->_style as $type => $content)
		{
			$buffer .= $tab . '<style type="' . $type . '">' . $lnEnd;

			// This is for full XHTML support.
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . '<![CDATA[' . $lnEnd;
			}

			$buffer .= $content . $lnEnd;

			// See above note
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . ']]>' . $lnEnd;
			}
			$buffer .= $tab . '</style>' . $lnEnd;
		}

		// Generate script file links
		$preferscript="";
		foreach ($document->_scripts as $strSrc => $strAttr)
		{
			
			if ($strAttr['prefer']){
				$preferscript .= $tab . '<script src="' . $strSrc . '"';
				$defaultMimes = array(
					'text/javascript', 'application/javascript', 'text/x-javascript', 'application/x-javascript'
				);

				if (!is_null($strAttr['mime']) && (!$document->isHtml5() || !in_array($strAttr['mime'], $defaultMimes)))
				{
					$preferscript .= ' type="' . $strAttr['mime'] . '"';
				}

				if ($strAttr['defer'])
				{
					$preferscript .= ' defer="defer"';
				}

				if ($strAttr['async'])
				{
					$preferscript .= ' async="async"';
				}
				$preferscript .= '></script>' . $lnEnd;

			}
			else{
				$buffer .= $tab . '<script src="' . $strSrc . '"';
				$defaultMimes = array(
					'text/javascript', 'application/javascript', 'text/x-javascript', 'application/x-javascript'
				);

				if (!is_null($strAttr['mime']) && (!$document->isHtml5() || !in_array($strAttr['mime'], $defaultMimes)))
				{
					$buffer .= ' type="' . $strAttr['mime'] . '"';
				}

				if ($strAttr['defer'])
				{
					$buffer .= ' defer="defer"';
				}

				if ($strAttr['async'])
				{
					$buffer .= ' async="async"';
				}
				$buffer .= '></script>' . $lnEnd;
			}

			
		}
		$buffer .=$preferscript;
		// Generate script declarations
		foreach ($document->_script as $type => $content)
		{
			$buffer .= $tab . '<script type="' . $type . '">' . $lnEnd;

			// This is for full XHTML support.
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . '<![CDATA[' . $lnEnd;
			}

			$buffer .= $content . $lnEnd;

			// See above note
			if ($document->_mime != 'text/html')
			{
				$buffer .= $tab . $tab . ']]>' . $lnEnd;
			}
			$buffer .= $tab . '</script>' . $lnEnd;
		}

		return $buffer;
	}
}
