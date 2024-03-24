import React, { useState, useEffect } from 'react';
import axios from 'axios'; // If fetching data from API
// import { fetchStaticPage } from '../api'; // If fetching data from a separate API function

const StaticPage = ({ pageName }) => {
    const [content, setContent] = useState('');

    useEffect(() => {
        // Fetch data from API or load from local storage
        // Example with axios (fetching from API)
        axios.get(`https://api.example.com/static-pages/${pageName}`)
            .then(response => {
                setContent(response.data.content);
            })
            .catch(error => {
                console.error('Error fetching static page:', error);
            });

        // Example with a separate API function
        // fetchStaticPage(pageName)
        //   .then(data => {
        //     setContent(data.content);
        //   })
        //   .catch(error => {
        //     console.error('Error fetching static page:', error);
        //   });
    }, [pageName]);

    return (
        <div className="container mx-auto px-4 py-8">
            <h1 className="text-3xl font-bold mb-4">{pageName}</h1>
            <div className="prose" dangerouslySetInnerHTML={{ __html: content }} />
        </div>
    );
};

export default StaticPage;
