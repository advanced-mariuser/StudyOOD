#include "Drawer.h"

void Drawer::DrawLine(Image& image, Point from, Point to, uint32_t color)
{
    const int deltaX = std::abs(to.x - from.x);
    const int deltaY = std::abs(to.y - from.y);

    if (deltaY > deltaX)
    {
        DrawSteepLine(image, from, to, color);
    }
    else
    {
        DrawSlopeLine(image, from, to, color);
    }
}

void Drawer::DrawCircle(Image& image, Point center, int radius, uint32_t color)
{
    // В этом алгоритме строится дуга окружности для первого квадранта, а координаты точек
    // окружности для остальных квадрантов получаются симметрично. На каждом шаге алгоритма
    // рассматриваются три пикселя, и из них выбирается наиболее подходящий путём сравнения
    // расстояний от центра до выбранного пикселя с радиусом окружности.
    int x = 0;
    int y = radius;
    int delta = 3 - 2 * radius;

    while (x <= y)
    {
        image.SetPixel({center.x + x, center.y + y}, color);
        image.SetPixel({center.x - x, center.y + y}, color);
        image.SetPixel({center.x + x, center.y - y}, color);
        image.SetPixel({center.x - x, center.y - y}, color);
        image.SetPixel({center.x + y, center.y + x}, color);
        image.SetPixel({center.x - y, center.y + x}, color);
        image.SetPixel({center.x + y, center.y - x}, color);
        image.SetPixel({center.x - y, center.y - x}, color);

        //Если d < 0, точка (x+1,y) остаётся в пределах окружности. Увеличиваем x, изменяя d
        //Горизонтальный шаг d(new) = d+2x+1+2x+1 = d+4x+6
        if (delta < 0)
        {
            delta = delta + 4 * x + 6;
        }
        //Если d ≥ 0, точка (x+1,y−1) выходит за пределы окружности. Уменьшаем y, изменяя d
        //Диагональный шаг d(new) = d+2x−2y+2+2x+1+2x−2y+2 = d+4(x−y)+10
        else
        {
            delta = delta + 4 * (x - y) + 10;
            --y;
        }
        ++x;
    }
}

void Drawer::FillCircle(Image& image, Point center, int radius, uint32_t color)
{
    int x = 0;
    int y = radius;
    int delta = 3 - 2 * radius;

    while (x <= y)
    {
        for (int i = -x; i <= x; ++i)
        {
            image.SetPixel({center.x + i, center.y + y}, color);
            image.SetPixel({center.x + i, center.y - y}, color);
        }
        for (int i = -y; i <= y; ++i)
        {
            image.SetPixel({center.x + i, center.y + x}, color);
            image.SetPixel({center.x + i, center.y - x}, color);
        }

        if (delta < 0)
        {
            delta = delta + 4 * x + 6;
        }
        else
        {
            delta = delta + 4 * (x - y) + 10;
            --y;
        }
        ++x;
    }
}

int Drawer::Sign(int value)
{
    return (0 < value) - (value < 0);
}

void Drawer::DrawSteepLine(Image& image, Point from, Point to, uint32_t color)
{
    const int deltaX = std::abs(to.x - from.x);
    const int deltaY = std::abs(to.y - from.y);

    assert(deltaY >= deltaX);

    if (from.y > to.y)
    {
        std::swap(from, to);
    }

    const int stepX = Sign(to.x - from.x);
    const int errorThreshold = deltaY + 1;
    const int deltaErr = deltaX + 1;

    int error = deltaErr / 2;

    for (Point p = from; p.y <= to.y; ++p.y)
    {
        image.SetPixel({ p.x, p.y }, color);

        error += deltaErr;

        if (error >= errorThreshold)
        {
            p.x += stepX;
            error -= errorThreshold;
        }
    }
}

void Drawer::DrawSlopeLine(Image& image, Point from, Point to, uint32_t color)
{
    const int deltaX = std::abs(to.x - from.x);
    const int deltaY = std::abs(to.y - from.y);

    assert(deltaX >= deltaY);

    if (from.x > to.x)
    {
        std::swap(from, to);
    }

    const int stepY = Sign(to.y - from.y);
    const int errorThreshold = deltaX + 1;
    const int deltaErr = deltaY + 1;

    int error = deltaErr / 2;

    for (Point p = from; p.x <= to.x; ++p.x)
    {
        image.SetPixel({ p.x, p.y }, color);

        error += deltaErr;

        if (error >= errorThreshold)
        {
            p.y += stepY;
            error -= errorThreshold;
        }
    }
}