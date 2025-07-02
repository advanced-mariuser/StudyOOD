#ifndef LAB9_IMAGESERVICE_H
#define LAB9_IMAGESERVICE_H

#include <iostream>
#include <sstream>
#include <fstream>
#include "Image.h"

class ImageService
{
public:
    static void Print(const Image& img, std::ostream& out);
    static Image LoadImage(const std::string& pixels);
    static void SaveImageToPPM(const Image& image, const std::string& filename);
};

#endif // LAB9_IMAGESERVICE_H
