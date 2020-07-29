<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Document class, provides an easy interface to parse and display a document
 */
class Document
{
	/**
	 * Document title
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $title = '';

	/**
	 * Document description
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $description = '';

	/**
	 * Document full URL
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $link = '';

	/**
	 * Document base URL
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $base = '';

	/**
	 * Contains the document language setting
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $language = 'en-gb';

	/**
	 * Tab string
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $_tab = "\11";

	/**
	 * Contains the line end string
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $_lineEnd = "\12";

	/**
	 * Contains the character encoding string
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $_charset = 'utf-8';

	/**
	 * Document mime type
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $_mime = '';

	/**
	 * Document namespace
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $_namespace = '';

	/**
	 * Document profile
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $_profile = '';
	public $_generator='NSS';
	public $_links = array();
	public $head=NULL;
	/**
	 * Array of linked scripts
	 *
	 * @var    array
	 * @since  11.1
	 */
	public $_scripts = array();

	/**
	 * Array of scripts placed in the header
	 *
	 * @var    array
	 * @since  11.1
	 */
	public $_script = array();

	/**
	 * Array of linked style sheets
	 *
	 * @var    array
	 * @since  11.1
	 */
	public $_styleSheets = array();

	/**
	 * Array of included style declarations
	 *
	 * @var    array
	 * @since  11.1
	 */
	public $_style = array();

	/**
	 * Array of meta tags
	 *
	 * @var    array
	 * @since  11.1
	 */
	public $_metaTags = array();

	/**
	 * The rendering engine
	 *
	 * @var    object
	 * @since  11.1
	 */
	public $_engine = null;
	
	/**
	 * Set to true when the document should be output as HTML%
	 *
	 * @var    boolean
	 * @since  12.1
	 */
	private $_html5 = null;

	/**
	 * The document type
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $_type = null;

	/**
	 * Array of buffered output
	 *
	 * @var    mixed (depends on the renderer)
	 * @since  11.1
	 */
	public static $_buffer = null;

	/**
	 * JDocument instances container.
	 *
	 * @var    array
	 * @since  11.3
	 */
	protected static $instances = array();

	/**
	 * Media version added to assets
	 *
	 * @var    string
	 * @since  3.2
	 */
	protected $mediaVersion = null;

	/**
	 * Class constructor.
	 *
	 * @param   array  $options  Associative array of options
	 *
	 * @since   11.1
	 */
	public function __construct($options = array())
	{
		if (array_key_exists('lineend', $options))
		{
			$this->setLineEnd($options['lineend']);
		}

		if (array_key_exists('charset', $options))
		{
			$this->setCharset($options['charset']);
		}

		if (array_key_exists('language', $options))
		{
			$this->setLanguage($options['language']);
		}

		if (array_key_exists('direction', $options))
		{
			$this->setDirection($options['direction']);
		}

		if (array_key_exists('tab', $options))
		{
			$this->setTab($options['tab']);
		}

		if (array_key_exists('link', $options))
		{
			$this->setLink($options['link']);
		}

		if (array_key_exists('base', $options))
		{
			$this->setBase($options['base']);
		}

		if (array_key_exists('mediaversion', $options))
		{
			$this->setMediaVersion($options['mediaversion']);
		}
	}

	/**
	 * Set the document type
	 *
	 * @param   string  $type  Type document is to set to
	 */
	public function setType($type)
	{
		$this->_type = $type;

		return $this;
	}
		/**
	 * Returns whether the document is set up to be output as HTML5
	 *
	 * @return  Boolean true when HTML5 is used
	 *
	 * @since   12.1
	 */
	public function isHtml5()
	{
		return $this->_html5;
	}
	/**
	 * Returns the document type
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getType()
	{
		return $this->_type;
	}

	/**
	 * Get the contents of the document buffer
	 *
	 * @return  The contents of the document buffer
	 *
	 * @since   11.1
	 */
	public function getBuffer()
	{
		return self::$_buffer;
	}

	/**
	 * Set the contents of the document buffer
	 *
	 * @param   string  $content  The content to be set in the buffer.
	 * @param   array   $options  Array of optional elements.
	 */
	public function setBuffer($content, $options = array())
	{
		self::$_buffer = $content;

		return $this;
	}

	/**
	 * Gets a meta tag.
	 *
	 * @param   string   $name       Value of name or http-equiv tag
	 * @param   boolean  $httpEquiv  META type "http-equiv" defaults to null
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getMetaData($name, $httpEquiv = false)
	{
		$name = strtolower($name);

		if ($name == 'generator')
		{
			$result = $this->getGenerator();
		}
		elseif ($name == 'description')
		{
			$result = $this->getDescription();
		}
		else
		{
			if ($httpEquiv == true)
			{
				$result = @$this->_metaTags['http-equiv'][$name];
			}
			else
			{
				$result = @$this->_metaTags['standard'][$name];
			}
		}

		return $result;
	}

	/**
	 * Sets or alters a meta tag.
	 *
	 * @param   string   $name        Value of name or http-equiv tag
	 * @param   string   $content     Value of the content tag
	 * @param   boolean  $http_equiv  META type "http-equiv" defaults to null
	 *
	 */
	public function setMetaData($name, $content, $http_equiv = false)
	{
		$name = strtolower($name);

		if ($name == 'generator')
		{
			$this->setGenerator($content);
		}
		elseif ($name == 'description')
		{
			$this->setDescription($content);
		}
		else
		{
			if ($http_equiv == true)
			{
				$this->_metaTags['http-equiv'][$name] = $content;
			}
			else
			{
				$this->_metaTags['standard'][$name] = $content;
			}
		}

		return $this;
	}

	/**
	 * Adds a linked script to the page
	 *
	 * @param   string   $url    URL to the linked script
	 * @param   string   $type   Type of script. Defaults to 'text/javascript'
	 * @param   boolean  $defer  Adds the defer attribute.
	 * @param   boolean  $async  Adds the async attribute.
	 *
	 */
	public function addScript($url, $prefer= false, $type = "text/javascript", $defer = false, $async = false)
	{
		$this->_scripts[$url]['mime'] = $type;
		$this->_scripts[$url]['defer'] = $defer;
		$this->_scripts[$url]['async'] = $async;
		$this->_scripts[$url]['prefer'] = $prefer;
		return $this;
	}

	
	/**
	 * Adds a linked stylesheet to the page
	 *
	 * @param   string  $url      URL to the linked style sheet
	 * @param   string  $type     Mime encoding type
	 * @param   string  $media    Media type that this stylesheet applies to
	 * @param   array   $attribs  Array of attributes
	 *
	 */
	public function addStyleSheet($url, $prefer= false, $type = 'text/css', $media = null, $attribs = array())
	{
		$this->_styleSheets[$url]['mime'] = $type;
		$this->_styleSheets[$url]['media'] = $media;
		$this->_styleSheets[$url]['attribs'] = $attribs;  
		$this->_styleSheets[$url]['prefer'] = $prefer;
        return $this;
	}
	/**
	 * Sets the document charset
	 *
	 * @param   string  $type  Charset encoding string
	 *
	 */
	public function setCharset($type = 'utf-8')
	{
		$this->_charset = $type;

		return $this;
	}

	/**
	 * Returns the document charset encoding.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getCharset()
	{
		return $this->_charset;
	}

	/**
	 * Sets the global document language declaration. Default is English (en-gb).
	 *
	 * @param   string  $lang  The language to be set
	 *
	 * @return  JDocument instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	public function setLanguage($lang = "en-gb")
	{
		$this->language = strtolower($lang);

		return $this;
	}

	/**
	 * Returns the document language.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	/**
	 * Sets the title of the document
	 *
	 * @param   string  $title  The title to be set
	 *
	 * @return  JDocument instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Return the title of the document.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set the assets version
	 *
	 * @param   string  $mediaVersion  Media version to use
	 *
	 */
	public function setMediaVersion($mediaVersion)
	{
		$this->mediaVersion = strtolower($mediaVersion);

		return $this;
	}

	/**
	 * Return the media version
	 *
	 * @return  string
	 *
	 * @since   3.2
	 */
	public function getMediaVersion()
	{
		return $this->mediaVersion;
	}

	/**
	 * Sets the base URI of the document
	 *
	 * @param   string  $base  The base URI to be set
	 *
	 */
	public function setBase($base)
	{
		$this->base = $base;

		return $this;
	}

	/**
	 * Return the base URI of the document.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getBase()
	{
		return $this->base;
	}

	/**
	 * Sets the description of the document
	 *
	 * @param   string  $description  The description to set
	 *
	 * @return  JDocument instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Return the title of the page.
	 *
	 * @return  string
	 *
	 * @since    11.1
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Sets the document link
	 *
	 * @param   string  $url  A url
	 *
	 */
	public function setLink($url)
	{
		$this->link = $url;

		return $this;
	}

	/**
	 * Returns the document base url
	 *
	 * @return string
	 *
	 * @since   11.1
	 */
	public function getLink()
	{
		return $this->link;
	}

	/**
	 * Sets the document generator
	 *
	 * @param   string  $generator  The generator to be set
	 *
	 */
	public function setGenerator($generator)
	{
		$this->_generator = $generator;

		return $this;
	}

	/**
	 * Returns the document generator
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getGenerator()
	{
		return $this->_generator;
	}


	/**
	 * Sets the document MIME encoding that is sent to the browser.
	 *
	 * This usually will be text/html because most browsers cannot yet
	 * accept the proper mime settings for XHTML: application/xhtml+xml
	 * and to a lesser extent application/xml and text/xml. See the W3C note
	 * ({@link http://www.w3.org/TR/xhtml-media-types/
	 * http://www.w3.org/TR/xhtml-media-types/}) for more details.
	 *
	 * @param   string   $type  The document type to be sent
	 * @param   boolean  $sync  Should the type be synced with HTML?
	 *
	 *
	 * @link    http://www.w3.org/TR/xhtml-media-types
	 */
	public function setMimeEncoding($type = 'text/html', $sync = true)
	{
		$this->_mime = strtolower($type);

		// Syncing with meta-data
		if ($sync)
		{
			$this->setMetaData('content-type', $type . '; charset=' . $this->_charset, true);
		}

		return $this;
	}

	/**
	 * Return the document MIME encoding that is sent to the browser.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function getMimeEncoding()
	{
		return $this->_mime;
	}

	/**
	 * Sets the line end style to Windows, Mac, Unix or a custom string.
	 *
	 * @param   string  $style  "win", "mac", "unix" or custom string.
	 *
	 * @return  JDocument instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	public function setLineEnd($style)
	{
		switch ($style)
		{
			case 'win':
				$this->_lineEnd = "\15\12";
				break;
			case 'unix':
				$this->_lineEnd = "\12";
				break;
			case 'mac':
				$this->_lineEnd = "\15";
				break;
			default:
				$this->_lineEnd = $style;
		}

		return $this;
	}

	/**
	 * Returns the lineEnd
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function _getLineEnd()
	{
		return $this->_lineEnd;
	}

	/**
	 * Sets the string used to indent HTML
	 *
	 * @param   string  $string  String used to indent ("\11", "\t", '  ', etc.).
	 *
	 * @return  JDocument instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	public function setTab($string)
	{
		$this->_tab = $string;

		return $this;
	}

	/**
	 * Returns a string containing the unit for indenting HTML
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public function _getTab()
	{
		return $this->_tab;
	}

	/**
	 * Load a renderer
	 *
	 * @param   string  $type  The renderer type
	 *
	 * @throws  RuntimeException
	 */
	public function loadRenderer($type)
	{
		$class = 'DocumentRenderer' . $type;

		if (!class_exists($class))
		{
			$path = dirname(__FILE__) . '/'. $type . '.php';

			if (file_exists($path))
			{
				require_once $path;
			}
			else
			{
				//throw new RuntimeException('Unable to load renderer class', 500);
			}
		}

		if (!class_exists($class))
		{
			return null;
		}

		$instance = new $class($this);

		$this->head = $instance;
	}

	/**
	 * Parses the document and prepares the buffers
	 *
	 * @param   array  $params  The array of parameters
	 *
	 * @return  JDocument instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	public function parse($params = array())
	{
		return $this;
	}

	public static function toString($array = null, $inner_glue = '=', $outer_glue = ' ', $keepOuterKey = false)
	{
		$output = array();

		if (is_array($array))
		{
			foreach ($array as $key => $item)
			{
				if (is_array($item))
				{
					if ($keepOuterKey)
					{
						$output[] = $key;
					}
					// This is value is an array, go and do it again!
					$output[] = self::toString($item, $inner_glue, $outer_glue, $keepOuterKey);
				}
				else
				{
					$output[] = $key . $inner_glue . '"' . $item . '"';
				}
			}
		}

		return implode($outer_glue, $output);
	}
}
