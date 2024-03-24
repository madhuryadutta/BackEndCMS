// src/components/Navbar.js
import React from "react";
import { Link } from "react-router-dom";
import { FaBars } from "react-icons/fa"; // Import FaBars icon
import config from "../utils/config";

const Navbar = () => {
    return (
        <nav className="bg-blue-900 py-4">
            <div className="container mx-auto px-4 flex justify-between items-center">
                <Link to="/" className="text-white font-bold text-xl">
                    {config.siteName}
                </Link>
                <div className="hidden md:block">
                    <Link to="/courses" className="text-white ml-4">
                        Courses
                    </Link>
                    <Link to="/about" className="text-white ml-4">
                        About
                    </Link>
                    <Link to="/contact" className="text-white ml-4">
                        Contact
                    </Link>
                </div>
                <div className="md:hidden">
                    <FaBars className="text-white text-2xl" />
                </div>
            </div>
        </nav>
    );
};

export default Navbar;
