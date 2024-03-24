// src/components/PostDetails.js
import React, { useState, useEffect, Suspense } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import Loader from './Loader';

const PostDetails = () => {
  const { postId } = useParams();
  const [post, setPost] = useState(null);

  useEffect(() => {
    axios.get(`https://dummyjson.com/posts/${postId}`)
      .then(response => {
        setPost(response.data);
      })
      .catch(error => {
        console.error('Error fetching post: ', error);
      });
  }, [postId]);

  return (
    <div className="container mx-auto px-4 py-8">
      <Suspense fallback={<Loader />}>
        <PostDetailsContent post={post} />
      </Suspense>
    </div>
  );
};

const PostDetailsContent = ({ post }) => {
  if (!post) {
    return <div><Loader /></div>;
  }

  return (
    <div>
      <h1 className="text-3xl font-bold mb-8">{post.title}</h1>
      <p className="text-gray-600 dark:text-gray-400">{post.body}</p>
    </div>
  );
};

export default PostDetails;
