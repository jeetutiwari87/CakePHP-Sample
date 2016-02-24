<?php
/**
 * Layout Helper
 *
 * PHP version 5
 *
 * @category Helper
 * @package  Intellichar
 * @version  1.0
 */
class LayoutHelper extends AppHelper {
/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Js',
    );
/**
 * Current Node
 *
 * @var array
 * @access public
 */
    public $node = null;
/**
 * Core helpers
 *
 * Extra supported callbacks, like beforeNodeInfo() and afterNodeInfo(),
 * won't be called for these helpers.
 *
 * @var array
 * @access public
 */
    public $coreHelpers = array(
        // CakePHP
        'Ajax',
        'Cache',
        'Form',
        'Html',
        'Javascript',
        'JqueryEngine',
        'Js',
        'MootoolsEngine',
        'Number',
        'Paginator',
        'PrototypeEngine',
        'Rss',
        'Session',
        'Text',
        'Time',
        'Xml'

    );
/**
 * Constructor
 *
 * @param array $options options
 * @access public
 */
    public function __construct($options = array()) {
        $this->View =& ClassRegistry::getObject('view');
        return parent::__construct($options);
    }

/**
 * Status
 *
 * instead of 0/1, show tick/cross
 *
 * @param integer $value 0 or 1
 * @return string formatted img tag
 */
    public function status($value) {
        if ($value == 1) {
            $output = $html->image('/img/icons/tick.png');
        } else {
            $output = $html->image('/img/icons/cross.png');
        }
        return $output;
    }

/**
 * Meta tags
 *
 * @return string
 */
    public function meta($metaForLayout = array()) {
        $_metaForLayout = array();
        if (is_array(Configure::read('Meta'))) {
            $_metaForLayout = Configure::read('Meta');
        }

        if (count($metaForLayout) == 0 &&
            isset($this->View->viewVars['node']['CustomFields']) &&
            count($this->View->viewVars['node']['CustomFields']) > 0) {
            $metaForLayout = array();
            foreach ($this->View->viewVars['node']['CustomFields'] AS $key => $value) {
                if (strstr($key, 'meta_')) {
                    $key = str_replace('meta_', '', $key);
                    $metaForLayout[$key] = $value;
                }
            }
        }

        $metaForLayout = array_merge($_metaForLayout, $metaForLayout);

        $output = '';
        foreach ($metaForLayout AS $name => $content) {
            $output .= '<meta name="' . $name . '" content="' . $content . '" />';
        }

        return $output;
    }
/**
 * isLoggedIn
 *
 * if User is logged in
 *
 * @return boolean
 */
    public function isLoggedIn() {
        if ($this->Session->check('Auth.User.id')) {
            return true;
        } else {
            return false;
        }
    }

/**
 * Get Role ID
 *
 * @return integer
 */
    public function getRoleId() {
        if ($this->isLoggedIn()) {
            $roleId = $this->Session->read('Auth.User.role_id');
        } else {
            // Public
            $roleId = 3;
        }
        return $roleId;
    }


/**
 * Converts strings like controller:abc/action:xyz/ to arrays
 *
 * @param string $link link
 * @return array
 */
    public function linkStringToArray($link) {
        $link = explode('/', $link);
        $linkArr = array();
        foreach ($link AS $linkElement) {
            if ($linkElement != null) {
                $linkElementE = explode(':', $linkElement);
                if (isset($linkElementE['1'])) {
                    $linkArr[$linkElementE['0']] = $linkElementE['1'];
                } else {
                    $linkArr[] = $linkElement;
                }
            }
        }
        if (!isset($linkArr['plugin'])) {
            $linkArr['plugin'] = false;
        }

        return $linkArr;
    }

/**
 * Show links under Actions column
 *
 * @param integer $id
 * @param array $options
 * @return string
 */
    public function adminRowActions($id, $options = array()) {
        $_options = array();
        $options = array_merge($_options, $options);

        $output = '';
        $rowActions = Configure::read('Admin.rowActions.' . Inflector::camelize($this->params['controller']) . '/' . $this->params['action']);
        if (is_array($rowActions)) {
            foreach ($rowActions AS $title => $link) {
                if ($output != '') {
                    $output .= ' ';
                }
                $link = $this->linkStringToArray(str_replace(':id', $id, $link));
                $output .= $html->link($title, $link);
            }
        }
        return $output;
    }
	/**
 * Show flash message
 *
 * @return void
 */
    public function sessionFlash() {
        $messages = $this->Session->read('Message');
        if( is_array($messages) ) {
            foreach(array_keys($messages) AS $key) {
                echo strip_tags($this->Session->flash($key));
            }
        }
    }
}
?>