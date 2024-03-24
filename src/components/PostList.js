// src/components/PostList.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

const PostList = () => {
  const [posts, setPosts] = useState([]);

  useEffect(() => {
    axios.get('https://dummyjson.com/posts')
      .then(response => {
        setPosts(response.data.posts);
      })
      .catch(error => {
        console.error('Error fetching posts: ', error);
      });
  }, []);

  return (
    <div className="container mx-auto px-4 py-8">
      <h1 className="text-3xl font-bold mb-8">Blog Posts</h1>
      {posts.map(post => (
        <Link key={post.id} to={`/post/${post.id}`} className="block mb-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
          <h2 className="text-xl font-semibold mb-2">{post.title}</h2>
          <p className="text-gray-600 dark:text-gray-400">{post.body.substring(0, 100)}...</p>
          <div className="flex items-center mt-2">
            <p className="text-gray-500">{post.tags.join(', ')}</p>
            <p className="ml-auto text-gray-500">{post.reactions} reactions</p>
          </div>
        </Link>
      ))}
    </div>
  );
};

export default PostList;
