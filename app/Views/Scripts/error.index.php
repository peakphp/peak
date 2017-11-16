<h1>Oops!! Something gone wrong!</h1>
<?php
if (isEnv('dev')) {
    echo '<pre>'.$this->error_trace.'</pre>';
}
