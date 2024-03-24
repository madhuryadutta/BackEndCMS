import React from 'react';
import { useParams } from 'react-router-dom';
import StaticPage from './StaticPage';

const RenderPage = () => {
    const { pageName } = useParams();

    return <StaticPage pageName={pageName} />;
};

export default RenderPage;
