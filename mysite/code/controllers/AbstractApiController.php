<?php
abstract class AbstractApiController extends Controller
{
    private static $allowed_actions = array(
        'index'
    );

    /** @var bool If the API has encountered an error, this should be set to true, setting {$this->setLastError()} will toggle this automatically */
    protected $hasError = false;

    /** @var string The last error message the API encountered should be stored here with {$this->setLastError()} */
    protected $lastError;

    /** @var string The item error message the API encountered should be stored here with {$this->setLastError()} */
    protected $itemError;


    /** @var int The status code which will be sent with the response */
    protected $statusCode = 200;

    /** @var array Allows you to maintain consistency by lazily calling $this->jsonOutput without parameters when */
    private static $default_output = array(
        'success' => true
    );

    /**
     * Index catcher, nothing to do here: 405 Method Not Allowed
     *
     * @return SS_HTTPRequest
     */
    public function index()
    {
        $this->setStatusCode(405)->setLastError('No endpoint specified. Please refer to the documentation provided to you');

        return $this->jsonOutput();
    }

    /**
     * @param array|null $data
     *
     * @return SS_HTTPRequest
     */
    public function jsonOutput($data = null)
    {
        $response = new SS_HTTPResponse();
        $response->addHeader('Content-Type', 'application/json');
        $response->setStatusCode($this->getStatusCode());

        if ($this->isHasError()) {
            return $response->setBody(Convert::array2json(array(
                'error'    => true,
                'message'  => $this->getLastError(),
                'itemError' => $this->getItemError()
            )));
        }

        return $response->setBody(Convert::array2json(array(
            'data'  => ($data) ? $data : Config::inst()->get(static::parentClass(), 'default_output'),
            'error' => false
        )));
    }

    /**
     * @param bool $bool
     *
     * @return $this
     */
    public function setHasError($bool)
    {
        $this->hasError = $bool;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasError()
    {
        return $this->hasError;
    }

    /**
     * @return mixed
     */
    public function getLastError()
    {
        return $this->lastError;
    }

    /**
     * @return mixed
     */
    public function getItemError()
    {
        return $this->itemError;
    }

    /**
     * @param string $lastError
     *
     * @return $this
     */
    public function setLastError($lastError, $itemError)
    {
        $this->setHasError(true);
        $this->lastError = $lastError;
        $this->itemError = $itemError;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}