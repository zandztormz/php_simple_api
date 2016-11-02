<?php

class Task
{
    public function __construct()
    {
        header('Content-Type: application/json');
    }

    public function index()
    {
        $string = self::readJson();
        return array(
            'status_code' => 200,
            'status' => 'ok',
            'data' => $string
        );
    }

    public function detail($id='')
    {
        $string = self::readJson();
        if(isset($string[$id])) {
            return array(
                'status_code' => 200,
                'status' => 'ok',
                'data' => $string[$id]
            );
        }
        return array(
            'status_code' => 404,
            'status' => 'Not Found',
        );
    }

    public function save($params)
    {
        $string = self::readJson();

        if(count($string)==0) {
            $last_id = 0;
        }else{
            end($string);
            $last_id = key($string);
        }

        if ($params['title'] == '') {

            return array(
                'status_code' => 406,
                'status' => 'Not Acceptable',
                'message' => 'title is require'
            );
        }

        if ($params['description'] == '') {

            return array(
                'status_code' => 406,
                'status' => 'Not Acceptable',
                'message' => 'description is require'
            );
        }

        $data = array(
            'title' => $params['title'],
            'description' => $params['description'],
            'status' => 'pending',
        );
        $string[$last_id+1] = $data;
        self::writeJson($string);

        return array(
            'status_code' => 200,
            'status' => 'true',
            'data' => $last_id+1
        );
    }

    public function update($params, $id)
    {
        $string = self::readJson();
        if (!isset($string[$id])) {
            return array(
                'status_code' => 404,
                'status' => 'Not Found',
            );
        }
        if ($params['title'] == '' || $params['description'] == '') {
               return array(
                   'status_code' => 406,
                   'status' => 'Not Acceptable',
               );
        }

        $string[$id]['title'] = $params['title'];
        $string[$id]['description'] = $params['description'];
        self::writeJson($string);
        return array(
            'status_code' => 200,
            'status' => 'ok',
            'data' => $id
        );
    }

    public function status($id)
    {
        $string = self::readJson();
        if (!isset($string[$id])) {
            return array(
                'status_code' => 404,
                'status' => 'Not Found',
            );
        }
        $string[$id]['status'] = $string[$id]['status']=='pending'?'done':'pending';
        self::writeJson($string);
        return array(
            'status_code' => 200,
            'status' => 'ok',
        );
    }

    public function delete($id)
    {
        $string = self::readJson();
        if (!isset($string[$id])) {
            return array(
                'status_code' => 404,
                'status' => 'Not Found',
            );
        }
        unset($string[$id]);
        self::writeJson($string);
        return array(
            'status_code' => 200,
            'status' => 'ok',
            'data' => $id
        );
    }

    private function writeJson($data)
    {
        return file_put_contents('data.json', json_encode($data));
    }

    private function readJson() {
        return json_decode(file_get_contents("data.json"),true);
    }
}