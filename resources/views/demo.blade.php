<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>API Response Display</title>
<style>
  /* Global styles */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
  }
  
  /* Container for posts */
  #apiResponse {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }

  /* Styles for individual post */
  .post {
    border: 1px solid #ddd;
    background-color: #fff;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Lazy loading */
    opacity: 0;
    transition: opacity 0.3s ease-in;
  }

  /* Title style */
  .post h2 {
    margin-top: 0;
    font-size: 24px;
    color: #333;
  }

  /* Meta information style */
  .post .meta {
    margin-bottom: 10px;
    font-size: 14px;
    color: #666;
  }

  /* Content style */
  .post .content {
    margin-bottom: 10px;
    font-size: 16px;
    color: #333;
  }

  /* Responsive image style */
  .post img {
    max-width: 100% !important;
    height: auto !important;
  }

  /* Media query for responsiveness */
  @media screen and (max-width: 600px) {
    .post {
      padding: 10px;
    }
  }
</style>
</head>
<body>
<div id="apiResponse"></div>

<script>
// Function to fetch data from the API endpoint using POST method
function fetchData() {
  // API endpoint URL
  const url = 'http://127.0.0.1:8000/api/v2';

  // Request parameters
  const params = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
      // Add any other headers if needed
    },
    // Add any data to be sent in the request body
    body: JSON.stringify({
      // Add any data if required
    })
  };

  // Fetch data
  fetch(url, params)
    .then(response => response.json())
    .then(data => displayPosts(data))
    .catch(error => console.error('Error fetching data:', error));
}

// Function to display the posts
function displayPosts(data) {
  const responseDiv = document.getElementById('apiResponse');
  data.forEach(post => {
    const postDiv = document.createElement('div');
    postDiv.classList.add('post');
    postDiv.innerHTML = `
      <h2>${post.title}</h2>
      <p class="meta">Posted on ${post.created_at} by User ID ${post.user_id}</p>
      <div class="content">${post.content_text}</div>
    `;
    responseDiv.appendChild(postDiv);
  });

  // Lazy loading for all posts
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = 1;
        observer.unobserve(entry.target);
      }
    });
  });

  document.querySelectorAll('.post').forEach(post => {
    observer.observe(post);
  });
}

// Call the function to fetch data when the page loads
document.addEventListener('DOMContentLoaded', fetchData);
</script>
</body>
</html>
