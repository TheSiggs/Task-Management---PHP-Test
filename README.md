# Rave Build PHP Coding Test
Welcome to the Rave Build PHP Coding Test! A lot of our product at Rave 
involves managing projects, and the tasks required to complete those projects.
This is reflected in this codebase, which is a few classes that represent some 
common functionality at Rave.
Your objectives are:

1. Get the tests passing
2. Ensure that all the code (and tests) meets a high standard (whatever that means to you)
3. Note down any choices or assumptions you made and why you made them in this README. For example, "I'm assuming that Task names are unique, otherwise they might not make sense" when compared to each other.
4. Note down what you would do if you had more time in this README
5. Delete the `vendor` directory, then zip this directory and email it to us

**Feel free to edit any files in this repository** as part of this exercise.

## Installation
PHP installations are quite complicated, so we have Dockerised the 
dependencies for this test in an attempt to simplify getting it running.
You need to:

1. Clone this Git repository
2. Install [Make](https://www.gnu.org/software/make/). For Windows
   [follow one of these instructions](https://stackoverflow.com/a/32127632).
   For MacOS, install with homebrew like `brew install make`. For Linux, use 
   your package manager like `apt install make`.
3. Install Docker. For Windows and MacOS we recommend 
   [installing Docker Desktop](https://docs.docker.com/desktop/install/windows-install/). 
   For Linux distributions we recommend
   [installing the Docker Engine](https://docs.docker.com/engine/install/).
4. Check that Docker is working by running `docker run hello-world`.

## Static Analysis
I have included phpstan for static analysis to ensure code quality
It can be used by running the following command `make phpstan`

## XDEBUG
I have included XDEBUG in the Dockerfile to make debugging more efficient

## Running the tests
Run `make test` to run the PHPUnit tests in a Docker container.

## Running program.php
Run `make run` to execute `program.php`. It is not required, but we have provided 
it if you would like to just run PHP code to debug things.

## My notes
### Choices or assumptions I made and reasons why
* I assumed that task names were unique
* Added phpstan for static analysis
* Added more test cases for a more complete test suite
* Added xdebug for easier debugging

### Things I would do if I had more time
* I would add check for duplicate task names
* More test cases (I may have missed some)
* Add validation to collection when initializing a project
* Improved Dockerfile (It was a quick and dirty solution for XDEBUG)
* Implemented a database solution for large datasets