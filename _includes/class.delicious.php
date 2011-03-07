<?php

class delicious_api_client
{
    public $auth_user;
    private $auth_passwd;
    private $api;
    private $curl;

    public function __construct()
    {
        $this->auth_user = $config['delicious_user'];
        $this->auth_passwd = $config['delicious_pass'];

        $this->curl = @curl_init();

        $this->api = array(
            'tags'         => "https://api.del.icio.us/v1/tags/get",
            'posts_recent'     => "https://api.del.icio.us/v1/posts/recent",
            'posts_dates'     => "https://api.del.icio.us/v1/posts/dates",
        );
        return;
    }

    private function api_response()
    {
        @curl_setopt($this->curl, CURLOPT_BINARYTRANSFER, 1); 
        @curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        @curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
        @curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
        @curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        @curl_setopt($this->curl, CURLOPT_USERPWD, $this->auth_user .":".$this->auth_passwd);
        $result = curl_exec($this->curl) or die('Error executing the HTTP Request.');

        return $result;
    }

    public function get_tags()
    {
        @curl_setopt($this->curl, CURLOPT_URL, $this->api['tags']);
        return $this->api_response();
    }

    public function get_posts_recent($limit = 50)
    {
        @curl_setopt($this->curl, CURLOPT_URL, $this->api['posts_recent'] ."?count=". $limit);
        return $this->api_response();
    }

    public function rename_tag($old,$new)
    {
        @curl_setopt($this->curl, CURLOPT_URL, $this->api['tags'] ."?old=". $old ."&new=". $new);
        return $this->api_response();
    }

    public function __destruct()
    {
        if (isset($this->curl))
        {
            @curl_close($this->curl);
        }
        return;
    }
}


class delicious_api_parser extends delicious_api_client
{
    public function __construct()
    {
        parent::__construct();
        return;
    }

    public function parse_posts_recent($limit = 50)
    {
        $xml = simplexml_load_string($this->get_posts_recent($limit));

        $post_count = count($xml->post);

        if (!$post_count)
        {
            die("No recent posts could be parsed from the xml node structure.");
        }

        $x = 0;
        while ($x < $post_count)
        {
            foreach($xml->post[$x]->attributes() as $a => $b) 
            {
                // $a = (count,tag)
                $a = strtolower($a);
                $posts[$x][$a] = $b;
            }

            $x++;
        }
        return $posts;
    }

    public function parse_tags()
    {
        $xml = simplexml_load_string($this->get_tags());

        $tag_count = count($xml->tag);

        if (!$tag_count)
        {
            die("No tags could be parsed from the xml node structure.");
        }

        $x = 0;
        while ($x < $tag_count)
        {
            foreach($xml->tag[$x]->attributes() as $a => $b) 
            {
                // $a = (count,tag)
                $a = strtolower($a);
                $tags[$x][$a] = $b;
            }

            $x++;
        }
        return $tags;
    }

    public function print_tags()
    {
        $tags = $this->parse_tags();
        $tag_count = count($tags);
        if ($tag_count > 0)
        {
            print "<ul>\n";
            $x = 0;
            while ($x < $tag_count)
            {
                print "<li><a href=\"http://del.icio.us/". $this->auth_user ."/".$tags[$x]['tag'] ."\">".$tags[$x]['tag'] ."</a> (".$tags[$x]['count'] .")</li>\n"; 
                $x++;
            }
            print "</ul>\n";
        }
        return;
    }

    public function print_posts_recent($limit = 50)
    {
        $posts = $this->parse_posts_recent($limit);
        $post_count = count($posts);
        if ($post_count > 0)
        {
            $x = 0;
            print "<ul>\n";
            while ($x < $post_count)
            {
                print "<li><strong><a href=\"".$posts[$x]['href'] ."\">".$posts[$x]['description'] ."</a></strong></li>\n"; 
                $x++;
            }
            print "</ul>\n";
        }
        return;
    }
}
