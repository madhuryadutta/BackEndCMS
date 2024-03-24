import React from 'react';

const Footer = () => {
    return (
        <footer className="bg-blue-900 text-white py-4">
            <div className="container mx-auto px-4 flex justify-between items-center">
                <p>&copy; 2022 EducationSite. All rights reserved.</p>
                <div>
                    <a href="/about/privacy_policy" className="text-white mr-4">Privacy Policy</a>
                    <a href="/about/terms_of_use" className="text-white mr-4">Terms of Service</a>
                    <a href="/about/refund_policy" className="text-white">Refund Policy</a>

                </div>
            </div>
        </footer>
    );
};

export default Footer;
