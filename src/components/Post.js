// src/components/Post.js
import React from "react";
import PropTypes from "prop-types";

const Post = ({ post }) => {
    const totalReactions = post.reactions.likes + post.reactions.dislikes;

    return (
        <div className="block mb-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h2 className="text-xl font-semibold mb-2">{post.title}</h2>
            <p className="text-gray-600 dark:text-gray-400">
                {post.body.substring(0, 100)}...
            </p>
            <div className="flex items-center mt-2">
                <p className="text-gray-500">{post.tags.join(", ")}</p>
                <p className="ml-auto text-gray-500">
                    {totalReactions} reactions
                </p>
            </div>
        </div>
    );
};

Post.propTypes = {
    post: PropTypes.shape({
        title: PropTypes.string.isRequired,
        body: PropTypes.string.isRequired,
        tags: PropTypes.arrayOf(PropTypes.string).isRequired,
        reactions: PropTypes.shape({
            likes: PropTypes.number.isRequired,
            dislikes: PropTypes.number.isRequired,
        }).isRequired,
    }).isRequired,
};

export default Post;
