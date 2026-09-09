<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class YouTubeService
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.youtube.key', '');
        $this->baseUrl = config('services.youtube.base_url', 'https://www.googleapis.com/youtube/v3');
    }

    /**
     * Search YouTube videos by keyword.
     */
    public function searchVideos(string $query, int $maxResults = 12): array
    {
        if (empty($this->apiKey)) {
            Log::warning('YouTube API key is missing.');
            return [];
        }

        $cacheKey = 'youtube_search_' . md5($query . '_' . $maxResults);

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($query, $maxResults) {
            try {
                $response = Http::withoutVerifying()->get("{$this->baseUrl}/search", [
                    'key' => $this->apiKey,
                    'q' => $query,
                    'part' => 'snippet',
                    'type' => 'video',
                    'maxResults' => $maxResults,
                ]);

                if ($response->successful()) {
                    return $response->json()['items'] ?? [];
                }

                Log::error('YouTube API Search Failed: ' . $response->body());
            } catch (\Throwable $e) {
                Log::error('YouTube API Search Exception: ' . $e->getMessage());
            }

            return [];
        });
    }

    /**
     * Get details for a specific video ID.
     */
    public function getVideoDetails(string $videoId): ?array
    {
        if (empty($this->apiKey)) {
            return null;
        }

        $cacheKey = 'youtube_video_' . $videoId;

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($videoId) {
            try {
                $response = Http::withoutVerifying()->get("{$this->baseUrl}/videos", [
                    'key' => $this->apiKey,
                    'id' => $videoId,
                    'part' => 'snippet,contentDetails,statistics',
                ]);

                if ($response->successful() && !empty($response->json()['items'])) {
                    return $response->json()['items'][0];
                }

                Log::error('YouTube API Video Details Failed: ' . $response->body());
            } catch (\Throwable $e) {
                Log::error('YouTube API Video Details Exception: ' . $e->getMessage());
            }

            return null;
        });
    }
}
