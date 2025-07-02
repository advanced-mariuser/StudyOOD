cmake_minimum_required(VERSION 3.8)

project(proxy-pattern)

enable_testing()

list(APPEND CMAKE_MODULE_PATH "${CMAKE_SOURCE_DIR}/cmake")

set(CMAKE_CXX_STANDARD 20)

add_subdirectory(src)

add_executable(proxy-pattern main.cpp)
target_link_libraries(proxy-pattern PRIVATE proxyPatternSrc)

add_subdirectory(tests)

add_dependencies(proxy-pattern run_tests)