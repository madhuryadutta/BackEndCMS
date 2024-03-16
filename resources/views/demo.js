// React equivalent of Demo.blade.php not tested yet 


// npm install bootstrap


import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  const [posts, setPosts] = useState([]);

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/v2', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
      });
      const data = await response.json();
      setPosts(data);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };

  return (
    <>
      <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
        <a className="navbar-brand" href="#">Navbar</a>
        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav mr-auto">
            <li className="nav-item active">
              <a className="nav-link" href="#">Home <span className="sr-only">(current)</span></a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">About</a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </nav>

      <div id="apiResponse" className="container py-4">
        {posts.map(post => (
          <div key={post.id} className="post card mb-3">
            <div className="card-body">
              <h2 className="card-title">{post.title}</h2>
              <p className="card-text meta">Posted on {post.created_at} by User ID {post.user_id}</p>
              <div className="card-text content" dangerouslySetInnerHTML={{ __html: post.content_text }}></div>
            </div>
          </div>
        ))}
      </div>

      <footer className="footer mt-auto py-3 bg-dark text-white">
        <div className="container text-center">
          <span>&copy; 2024 Your Company Name</span>
        </div>
      </footer>
    </>
  );
}

export default App;
