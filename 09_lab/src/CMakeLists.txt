FILE(GLOB_RECURSE SRC "*.h" "*.cpp")
add_library(proxyPatternSrc ${SRC})
target_include_directories(proxyPatternSrc PUBLIC ${CMAKE_CURRENT_SOURCE_DIR})