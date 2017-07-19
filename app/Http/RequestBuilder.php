<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 20:46
 */

namespace Mt4\ContatosAvaliacao\Http;


class RequestBuilder
{
    /**
     * @var array
     */
    protected $server;

    /**
     * @var array
     */
    protected $post;

    /**
     * @var array
     */
    protected $get;
    
    public function __construct($server, $post, $get)
    {
        $this->server = $server;
        $this->post = $post;
        $this->get = $get;
    }

    /**
     * @return array
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get;
    }
    
}