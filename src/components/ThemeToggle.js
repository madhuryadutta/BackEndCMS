import React, { useState, useEffect } from "react";
import axios from "axios";
import config from "../utils/config";

const ThemeToggle = () => {
    const [darkMode, setDarkMode] = useState(() => {
        const savedMode = localStorage.getItem("theme");
        return savedMode === "dark";
    });

    useEffect(() => {
        document.documentElement.classList.toggle("dark", darkMode);
        localStorage.setItem("theme", darkMode ? "dark" : "light");
        if (darkMode !== localStorage.getItem("theme")) {
            updateUserSettings({ theme: darkMode ? "dark" : "light" });
        }
    }, [darkMode]);

    const toggleDarkMode = () => {
        setDarkMode((prevMode) => !prevMode);
    };

    const updateUserSettings = async (data) => {
        try {
            // await axios.put(`${config.apiUrl}/user/settings`, data);
            await axios.put(`${config.apiUrl}/test`, data);
            console.log("User settings updated successfully");
        } catch (error) {
            console.error("Failed to update user settings:", error);
        }
    };

    return (
        <button
            className="fixed bottom-4 right-4 px-4 py-2 rounded-full bg-gray-800 text-white focus:outline-none"
            onClick={toggleDarkMode}
        >
            {darkMode ? "Light Mode" : "Dark Mode"}
        </button>
    );
};

export default ThemeToggle;
