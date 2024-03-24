import React, { useState, useEffect, useRef, useCallback } from 'react';
import axios from 'axios';
import config from '../utils/config';
import { Link } from 'react-router-dom';
import Loader from './Loader';
import Post from './Post'; // Assuming you have a Post component defined

const PostList = () => {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [page, setPage] = useState(1);
  const [hasMore, setHasMore] = useState(true);
  const observer = useRef();

  const fetchPosts = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axios.get(`${config.apiUrl}/posts?_page=${page}&_limit=10`);
      const newPosts = response.data.posts; // Assuming posts are nested under "posts" key
      setPosts(prevPosts => [...prevPosts, ...newPosts]);
      setHasMore(newPosts.length > 0);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching posts: ', error);
      setLoading(false);
    }
  }, [page]);

  useEffect(() => {
    fetchPosts();
    return () => {
      if (observer.current) {
        observer.current.disconnect();
      }
    };
  }, [fetchPosts]);

  useEffect(() => {
    if (!hasMore) return;
    if (loading) return;

    const options = {
      root: null,
      rootMargin: '20px',
      threshold: 0.1
    };

    observer.current = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        setPage(prevPage => prevPage + 1);
      }
    }, options);

    if (observer.current) {
      observer.current.observe(document.querySelector('.loaderRef'));
    }

  }, [loading, hasMore]);

  return (
    <div className="min-h-screen bg-gray-100 dark:bg-gray-900">
      <div className="container mx-auto px-4 py-8">
        <h1 className="text-3xl font-bold mb-8">Blog Posts</h1>
        {posts.map((post, index) => (
          <Link key={post.id || index} to={`/post/${post.id}`}>
            <Post post={post} />
          </Link>
        ))}

        <div className="loaderRef" />
        {loading && <Loader />}
      </div>
    </div>
  );
};

export default PostList;
