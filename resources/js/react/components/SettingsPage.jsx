import {React, useState} from "react";
import {Card, Page, Button, Stack} from '@shopify/polaris';

function SettingsPage() {
    const [enabled, setEnabled] = useState(false);

    const enableDisableApp = () => {
        console.log('clicked');
        if (enabled) {
            setEnabled(false)
        } else {
            // TODO: make necessary setup
            setEnabled(true)
        }
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
