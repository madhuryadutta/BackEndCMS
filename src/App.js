// src/App.js
import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import PostList from './components/PostList';
import PostDetails from './components/PostDetails'; // Create this component
import ThemeToggle from './components/ThemeToggle';
import Navbar from './components/Navbar';
import Footer from './components/Footer';
import RenderPage from './components/RenderPage';
import 'tailwindcss/tailwind.css';

function App() {
	return (
		<Router>
			<div className="dark:bg-gray-900 dark:text-white min-h-screen">
				<Navbar />
				<Routes>
					<Route path="/" element={<PostList />} />
					<Route path="/post/:postId" element={<PostDetails />} />
					<Route path="/about/:pageName" element={<RenderPage />} /> {/* Use RenderPage component */}
				</Routes>
				<Footer />
				<ThemeToggle />
			</div>
		</Router>
	);
}

export default App;
