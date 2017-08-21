<?php
try {
    try {
        include __DIR__."/src/autoload.php";
        Handler\RkyRoute::run();
    } catch (\Exception $e) {
        var_dump($e->getMessage());
        die(1);
    } catch (\Error $e) {
        var_dump($e->getMessage());
        die(1);
    } catch (\ErrorException $e) {
        var_dump($e->getMessage());
        die(1);
    } catch (\TypeError $e) {
        var_dump($e->getMessage());
        die(1);
    } catch (\ArgumentCountError $e) {
        var_dump($e->getMessage());
        die(1);
    } catch (\ParseError $e) {
        var_dump($e->getMessage());
        die(1);
    }
} catch (\Error $e) {
    var_dump($e->getMessage());
    die(1);
} finally {
}
