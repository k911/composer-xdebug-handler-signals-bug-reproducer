# Bug Reproducer
`Composer\XdebugHandler` does not forward signals to restarted process, making them unusable.

## Reproducer `signals.php`

Requirements: `xdebug` and `pcntl` PHP extensions enabled

1. At first run command without restarting process, and after some time press `CTRL-C` combination (or send `SIGINT` signal, using `kill -SIGINT PID`)

    ```bash
    ➜ APP_ALLOW_XDEBUG=1 php signals.php

    # output:
    # 
    # Hello from PID: 11087
    # Started!
    # ^C
    # Stopping..
    # Stopped after 974 ms
    ```

2. Then, execute script without `APP_ALLOW_XDEBUG` environment variable

    ```bash
    ➜ php signals.php 

    # output:
    # Hello from PID: 11677
    # Hello from PID: 11678
    # Started!
    # ^C
    ```

    As you can see, process was stopped, but signal handler were never executed due to CLI sends it to first process not to the child. Of you could say, send signal to second process, which will execute signal and end process, but it makes CLI commands being unfriendly.

