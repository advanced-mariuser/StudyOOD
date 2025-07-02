#include "Image.h"

Image::Image(Size size, uint32_t color)
        : m_size(size),
          m_tiles((size.height + Tile::SIZE - 1) / Tile::SIZE, // Количество строк тайлов
                  std::vector<CoW<Tile>>((size.width + Tile::SIZE - 1) / Tile::SIZE, // Количество столбцов тайлов
                                         CoW<Tile>(Tile(color))))
{}
//Исправить реализацию height и width при создании верктора векторов tiles (исправил)

Size Image::GetSize() const noexcept
{
    return m_size;
}

uint32_t Image::GetPixel(Point p) const noexcept
{
    if (p.x < 0 || p.x >= m_size.width || p.y < 0 || p.y >= m_size.height)
    {
        return 0xFFFFFF; // Возвращаем цвет по умолчанию для недопустимых координат
    }

    int tileX = p.x / Tile::SIZE;
    int tileY = p.y / Tile::SIZE;
    int pixelX = p.x % Tile::SIZE;
    int pixelY = p.y % Tile::SIZE;

    return m_tiles[tileY][tileX]->GetPixel({ pixelX, pixelY });
}

void Image::SetPixel(Point p, uint32_t color)
{
    if (p.x < 0 || p.x >= m_size.width || p.y < 0 || p.y >= m_size.height)
    {
        return; // Игнорируем попытки установить пиксель вне границ изображения
    }

    int tileX = p.x / Tile::SIZE;
    int tileY = p.y / Tile::SIZE;
    int pixelX = p.x % Tile::SIZE;
    int pixelY = p.y % Tile::SIZE;

    // Класс Image использует CoW для управления тайлами (Tile) изображения
    // Каждый пиксель изображения находится внутри сетки тайлов
    // Если тайл разделяется между несколькими экземплярами Image, он копируется только при изменении
    auto&& d = m_tiles[tileY][tileX];
    d.Write()->SetPixel({ pixelX, pixelY }, color);
}