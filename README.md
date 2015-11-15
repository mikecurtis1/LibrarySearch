# LibrarySearch

A mini-framework for merging search results from multiple, remote data 
sources

LibrarySearch runs "modules" which consist of: 

1. one front-end controller to process a request
2. one view to compose and render the UI
3. one HTML template 

Each module runs one or more "processes" consisting of four 
components: 

1. one query interpreter
2. one DAO (data access object)
3. one element extractor
4. one record builder

These processes access data from remote systems and model it 
into record objects.

# Configuration

# Creating a Module

# Creating a Process

# Reference

Various standards and conventions that LibrarySearch partially implements.

[PSR Naming Conventions](http://www.php-fig.org/bylaws/psr-naming-conventions/)

[PSR-1: Basic Coding Standard](http://www.php-fig.org/psr/psr-1/)

[PSR-2: Coding Style Guide](http://www.php-fig.org/psr/psr-2/)

[Zend Recommended Project Directory Structure](http://framework.zend.com/manual/1.12/en/project-structure.project.html)
