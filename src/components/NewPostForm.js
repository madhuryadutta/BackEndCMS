// src/components/NewPostForm.js
import React, { useState } from "react";
import axios from "axios";

const NewPostForm = ({ onAddPost }) => {
    const [title, setTitle] = useState("");
    const [content, setContent] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        axios
            .post("http://localhost:8000/api/posts", { title, content })
            .then((response) => {
                onAddPost(response.data);
                setTitle("");
                setContent("");
            })
            .catch((error) => {
                console.error("Error creating post: ", error);
            });
    };

    return (
        <div className="container mx-auto px-4 py-8">
            <h2 className="text-3xl font-bold mb-8">Create New Post</h2>
            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <label
                        htmlFor="title"
                        className="block text-sm font-semibold mb-2"
                    >
                        Title
                    </label>
                    <input
                        type="text"
                        id="title"
                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        value={title}
                        onChange={(e) => setTitle(e.target.value)}
                    />
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="content"
                        className="block text-sm font-semibold mb-2"
                    >
                        Content
                    </label>
                    <textarea
                        id="content"
                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        value={content}
                        onChange={(e) => setContent(e.target.value)}
                    ></textarea>
                </div>
                <button
                    type="submit"
                    className="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                >
                    Submit
                </button>
            </form>
        </div>
    );
};

export default NewPostForm;
