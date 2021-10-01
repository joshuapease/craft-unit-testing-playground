## Running the App

Run `docker-compose up`. The app will now be accessible at <http://craftunit.test>.

This command starts all of the containers that are needed to run the app:

- NGINX
- PHP
- MySQL

You can execute commands on the containers using the following syntax:

```sh
docker-compose exec <container> <command>
```

Example commands you could run

```sh
docker-compose exec php ./craft migrate/all
```

### Bash Commands

There are a number of bash commands to simplify running commands that are prefixed with `docker-compose exec`:

| Bash Command   | Full Command                                   |
| -------------- | ---------------------------------------------- |
| `bin/codecept` | `docker-compose exec test vendor/bin/codecept` |
| `bin/composer` | `docker-compose exec php composer`             |
| `bin/craft`    | `docker-compose exec php ./craft`              |

### Resetting the Database

We're storing all the MySQL data in a Docker [volume](https://docs.docker.com/storage/volumes/), and if you want to reset the database (like to reimport a new dump from scratch), you'll need to delete the volume:

1. Stop Docker
2. Attempt to delete the volume: `docker volume rm craftunit_db`
3. It'll fail with a message like:

    ```
    Error response from daemon: remove craftunit_db: volume is in use - [8e9eb5fc23a443f5f646468a341e2800dbb0caaeb7410d7e77a349c2f83e182e]
    ```

4. Take that container ID (`8e9db5...`) and run `docker rm [container]`
5. Rerun `docker volume rm craftunit_db` -- it'll work this time
6. Restart Docker (`docker-compose up`) and it will reinitialize the database
