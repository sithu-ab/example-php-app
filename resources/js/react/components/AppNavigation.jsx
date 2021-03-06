import React from "react";
import {AppLink, NavigationMenu} from '@shopify/app-bridge/actions';
import {useAppBridge} from '@shopify/app-bridge-react';
import {useLocation} from 'react-router-dom';

function AppNavigation() {
    const app = useAppBridge();

    const location = useLocation();

    const home = AppLink.create(app, {
        label: 'Home',
        destination: '/',
    });

    const product = AppLink.create(app, {
        label: 'Products',
        destination: '/products',
    });

    const example = AppLink.create(app, {
        label: 'Example',
        destination: '/example',
    });

    const navigationMenu = NavigationMenu.create(app, {
        items: [home, product, example],
    });

    switch (location.pathname) {
        case "/":
            navigationMenu.set({active: home});
            break;
        case "/products":
            navigationMenu.set({active: product});
            break;
        case "/example":
            navigationMenu.set({active: example});
            break;
        default:
            navigationMenu.set({active: undefined});
    }

    return null
}

export default AppNavigation;
