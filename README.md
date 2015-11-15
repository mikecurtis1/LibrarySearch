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
