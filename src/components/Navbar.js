// src/components/Navbar.js
import React from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
    return (
        <nav className="bg-primary py-4">
            <div className="container mx-auto px-4 flex justify-between items-center">
                <Link to="/" className="text-white font-bold text-xl">My Blog</Link>
                <div>
                    <Link to="/about" className="text-white mr-4">About</Link>
                    <Link to="/contact" className="text-white">Contact</Link>
                </div>
            </div>
        </nav>
    );
};

export default Navbar;
