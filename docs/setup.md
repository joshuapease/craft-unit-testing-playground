# Setup

Docker may conflict over port usage with other local host tools like MAMP. Turn these off before running the site with Docker.

1. Install Docker

    This configuration has been tested with version 3.6.0. If you have an older version (especially pre-2.3), run "Check for updates..." and install.

1. Set up host

    Open `/etc/hosts` and add:

    ```
    127.0.0.1 craftunit.test
    ```

    Then run `sudo killall -HUP mDNSResponder` to flush your DNS cache.

    [How to edit your Mac's Hosts file and why you would want to](https://www.imore.com/how-edit-your-macs-hosts-file-and-why-you-would-want)

1. Build the containers

    Run `docker compose build`. This will take a little while.

1. Start the containers

    Run `docker compose up`.

1. Trust SSL certificate (optional)

    > **Optional:** This step is only required if you use `https` in your `PRIMARY_SITE_URL` environment variable.

    Get a copy of the self-signed certificate created in the `nginx` container by running `bin/get-cert`. This will copy the self-signed cert to `./certs/craftunit.crt`

    Next, open the Keychain Access program. Drag the file from `./certs` into the "Certificates" panel in Keychain Access. Double-click the newly added certificiate to open a detail window, then select "Always Trust" from the dropdown menu. Reload site in Safari or restart (Chrome) to see changes take effect.

    **⚠️ Note:** You may need to repeat this step if the `nginx` container is rebuilt and a new certificate is created.

1. Setup Env

    Run `cp .env.example .env`

1. Install Craft

    Run `bin/craft setup` to install Craft.
