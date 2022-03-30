import {React, useState} from "react";
import {Card, Page, Button, Stack} from '@shopify/polaris';
import axios from "axios";

function SettingsPage(props) {
    const [enabled, setEnabled] = useState(false);
    const {shopOrigin, appDomain} = props.config;

    const enableDisableApp = () => {
        let mode = enabled ? 'disable' : 'enable';

        axios.post(`${appDomain}/api/app/${mode}?shop=${shopOrigin}`)
            .then(res => {
                console.log(res.data);
                setEnabled(res.data.enabled)
            })
    }

    return (
        <Page title="Multi Address Setting">
            <Card sectioned title="Shipping to Multiple Addresses">
                <Stack alignment="center">
                    <Stack.Item fill>
                        <p>Configure your multiple shipping address checkout flow</p>
                    </Stack.Item>
                    <Button primary onClick={enableDisableApp}>{ enabled ? 'Disable' : 'Enable'}</Button>
                </Stack>
            </Card>
        </Page>
    )
}

export default SettingsPage;
