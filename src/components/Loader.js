import React from "react";

const Loader = () => {
    return (
        <div className="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-white dark:bg-gray-900 opacity-75 z-50">
            <div className="flex flex-col items-center">
                <div className="w-20 h-20 border-4 border-t-4 border-gray-200 rounded-full animate-spin"></div>
                <div className="mt-4 text-gray-600 dark:text-gray-400">
                    Loading...
                </div>
            </div>
        </div>
    );
};

export default Loader;
