// src/components/PostList.js
import React, { useState, useEffect, Suspense } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import Loader from './Loader';

const Post = React.lazy(() => import(/* webpackChunkName: "Post" */ './Post'));

const PostList = () => {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('https://dummyjson.com/posts')
      .then(response => {
        setPosts(response.data.posts);
        setLoading(false);
      })
      .catch(error => {
        console.error('Error fetching posts: ', error);
        setLoading(false);
      });
  }, []);

  return (
    <div className="min-h-screen bg-gray-100 dark:bg-gray-900">
      <Suspense fallback={<Loader />}>
        <div className="container mx-auto px-4 py-8">
          <h1 className="text-3xl font-bold mb-8">Blog Posts</h1>
          {loading && <Loader />}
          {!loading && posts.map(post => (
            <Link key={post.id} to={`/post/${post.id}`}>
              <Post post={post} />
            </Link>
          ))}
        </div>
      </Suspense>
    </div>
  );
};

export default PostList;
