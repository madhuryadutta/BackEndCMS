<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // ---------------------------------------------------------

    public function extractKeywords($post, $topN = 5)
    {
        // Remove common words or stopwords
        $stopwords = [
            'the', 'i', 'a', 'an', 'of', 'in', 'on', 'at', 'for', 'to', 'by', 'with', 'as', 'from', 'is', 'are', 'am', 'was', 'were', 'be', 'been', 'being', 'have', 'has', 'had', 'do', 'does', 'did', 'can', 'could', 'will', 'would', 'shall', 'should', 'must', 'might',    'the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I',
            'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at',
            'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she',
            'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what',
            'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'go', 'me',
            'when', 'make', 'can', 'like', 'time', 'no', 'just', 'him', 'know', 'take',
            'people', 'into', 'year', 'your', 'good', 'some', 'could', 'them', 'see', 'other',
            'than', 'then', 'now', 'look', 'only', 'come', 'its', 'over', 'think', 'also',
            'back', 'after', 'use', 'two', 'how', 'our', 'work', 'first', 'well', 'way',
            'even', 'new', 'want', 'because', 'any', 'these', 'give', 'day', 'most', 'us',
            'are', 'is', 'was', 'were', 'been', 'being', 'have', 'has', 'had', 'do',
            'does', 'did', 'can', 'could', 'will', 'would', 'shall', 'should', 'may', 'might',
            'must', 'ought', 'here', 'there', 'where', 'when', 'why', 'how', 'all', 'any',
            'both', 'each', 'few', 'more', 'some', 'such', 'no', 'nor', 'not', 'only',
            'own', 'same', 'so', 'than', 'too', 'very', 's', 't', "can't", 'cannot',
            "don't", "aren't", "isn't", "didn't", "wasn't", "weren't", "hasn't", "haven't", "hadn't",
            "won't", "wouldn't", "shan't", "shouldn't", "mightn't", "mustn't", "let's", "that's", "who's", "what's",
            "here's", "there's", "when's", "where's", "why's", "how's", 'a', 'an', 'the', 'and',
            'but', 'if', 'or', 'because', 'as', 'until', 'while', 'of', 'at', 'by',
            'for', 'with', 'about', 'against', 'between', 'into', 'through', 'during', 'before', 'after',
            'above', 'below', 'to', 'from', 'up', 'down', 'in', 'out', 'on', 'off',
            'over', 'under', 'again', 'further', 'then', 'once', 'here', 'there', 'when', 'where',
            'why', 'how', 'all', 'any', 'both', 'each', 'few', 'more', 'most', 'other',
            'some', 'such', 'no', 'nor', 'not', 'only', 'own', 'same', 'so', 'than',
            'too', 'very', 's', 't', 'can', 'will', 'just', 'don', "don't", 'should',
            "should've", 'now', 'd', 'll', 'm', 'o', 're', 've', 'y', 'ain', 'aren',
            "aren't", 'couldn', "couldn't", 'didn', "didn't", 'doesn', "doesn't", 'hadn', "hadn't",
            'hasn', "hasn't", 'haven', "haven't", 'isn', "isn't", 'ma', 'mightn', "mightn't",
            'mustn', "mustn't", 'needn', "needn't", 'shan', "shan't", 'shouldn', "shouldn't", 'wasn',
            "wasn't", 'weren', "weren't", 'won', "won't", 'wouldn', "wouldn't",
        ];

        // Assign the processed text to a variable
        $post = strip_tags($post); // Remove HTML tags
        $post = preg_replace('/<a\s+(?:[^>]*?\s+)?href="([^"]*)"([^>]*)>(.*?)<\/a>/si', '', $post); // Remove links
        $post = str_replace('"', '', $post); // Remove double quotes
        $post = strtolower($post); // Convert text to lowercase
        $post = preg_replace("/[^\w\s]/", '', $post); // Remove punctuation marks

        // Split text into an array of words
        $words = preg_split('/\s+/', $post);

        // Remove stopwords and count word frequency
        $wordCount = array_count_values(array_diff($words, $stopwords));

        // Sort the words by frequency
        arsort($wordCount);

        // Extract top N keywords
        $topKeywords = array_slice(array_keys($wordCount), 0, $topN);

        return $topKeywords;
    }

    public function keygen($post)
    {
        $post = strip_tags($post);
        // Decode HTML entities
        $post = htmlspecialchars_decode($post, ENT_QUOTES);

        // Remove special characters and quotes
        $post = preg_replace('/[^\w\s]/', '', $post);

        $post = preg_replace('/\s+/', ' ', $post);
        $post = trim($post);

        // Execute the Python script
        $command = escapeshellcmd('python ./keyword_extraction.py '.escapeshellarg($post));
        $output = shell_exec($command);

        // Convert the output string to an array
        $data['keywords'] = explode("\n", trim($output));

        return $data['keywords'];
        exit;
    }
}
