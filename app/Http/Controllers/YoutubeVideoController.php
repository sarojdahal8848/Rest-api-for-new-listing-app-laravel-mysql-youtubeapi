<?php

namespace App\Http\Controllers;

use App\YoutubeVideo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YoutubeVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $res = $client->request('GET','https://youtube.googleapis.com/youtube/v3/videos?part=snippet&chart=mostPopular&maxResults=100&regionCode=NP&key=AIzaSyCWu4H4ZNgLd_BWGoy8OAWmXcH3uHfRaHM');
        $body = $res->getBody();
        $data =json_decode($body,true);
        $data =$data['items'];
        $ar =[];
        for($i=0;$i<count($data);$i++){
            $ar[$i]=array('title'=>$data[$i]['snippet']['title'],'video_id'=>$data[$i]['id'],'thumbnail'=>$data[$i]['snippet']['thumbnails']['default']['url']);
        }
        $a =json_encode($ar);
        return json_decode($a);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function show(YoutubeVideo $youtubeVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(YoutubeVideo $youtubeVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, YoutubeVideo $youtubeVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\YoutubeVideo  $youtubeVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(YoutubeVideo $youtubeVideo)
    {
        //
    }
}
