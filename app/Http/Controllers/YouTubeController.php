<?php

namespace App\Http\Controllers;

use App\Services\YouTubeService;
use Illuminate\Http\Request;

class YouTubeController extends Controller
{
    protected YouTubeService $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    /**
     * Search and list YouTube videos.
     */
    public function index(Request $request)
    {
        $query = $request->input('q', 'Laravel tutorials');
        $videos = $this->youtubeService->searchVideos($query, 12);

        return view('youtube.index', compact('videos', 'query'));
    }

    /**
     * Show single YouTube video player & details.
     */
    public function show(string $id)
    {
        $video = $this->youtubeService->getVideoDetails($id);

        if (!$video) {
            return redirect()->route('youtube.index')->with('error', 'Video not found or YouTube API error.');
        }

        return view('youtube.show', compact('video'));
    }
}
