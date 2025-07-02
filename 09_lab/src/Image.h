#ifndef LAB9_IMAGE_H
#define LAB9_IMAGE_H

#include <cassert>
#include <iostream>
#include <vector>
#include "CoW.h"
#include "Tile.h"
#include "Size.h"

class Image {
public:
    explicit Image(Size size, uint32_t color = 0xFFFFFF);

    [[nodiscard]] Size GetSize() const noexcept;
    [[nodiscard]] uint32_t GetPixel(Point p) const noexcept;
    void SetPixel(Point p, uint32_t color);

private:
    Size m_size;
    std::vector<std::vector<CoW<Tile>>> m_tiles;
};

#endif // LAB9_IMAGE_H