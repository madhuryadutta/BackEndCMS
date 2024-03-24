// src/App.js
import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import PostList from './components/PostList';
import PostDetails from './components/PostDetails'; // Create this component
// import ThemeToggle from './components/ThemeToggle';
import 'tailwindcss/tailwind.css';

function App() {
	return (
		<Router>
			<div className="dark:bg-gray-900 dark:text-white min-h-screen">
				<Routes>
					<Route path="/" element={<PostList />} />
					<Route path="/post/:postId" element={<PostDetails />} />

				</Routes>
			</div>
		</Router>
	);
}

export default App;
