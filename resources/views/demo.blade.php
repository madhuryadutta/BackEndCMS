<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>API Response Display</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  /* Global styles */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
  }

  /* Navigation styles */
  nav {
    background-color: #333;
    color: #fff;
    padding: 10px;
  }

  /* Footer styles */
  footer {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
  }

  /* Container for posts */
  #apiResponse {
    max-width: 1200px; /* Adjust max-width as needed incase of any issue chnage it to 1000px or 800px */
    margin: 0 auto;
    padding: 20px;
    padding-top: 70px; /* Adjust for space occupied by nav */
    padding-bottom: 70px; /* Adjust for space occupied by footer */
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

  /* Clearfix for floats */
  .clearfix::after {
    content: "";
    clear: both;
    display: table;
  }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
</nav>

<div id="apiResponse"></div>

<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted">&copy; 2024 Your Company Name</span>
  </div>
</footer>

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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
