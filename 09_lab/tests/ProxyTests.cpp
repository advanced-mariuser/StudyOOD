#include "catch2/catch_test_macros.hpp"
#include "../src/Image.h"

struct TestFixture
{
    TestFixture()
    {
        while (Tile::GetInstanceCount() > 0)
        {
        }
    }

    ~TestFixture()
    {
        REQUIRE(Tile::GetInstanceCount() == 0);
    }
};

TEST_CASE("Image Tests", "[Image]")
{
    TestFixture fixture;

    SECTION("Create Image With Single Color")
    {
        Image img({64, 64}, '*');

        REQUIRE(img.GetSize().width == 64);
        REQUIRE(img.GetSize().height == 64);

        for (int y = 0; y < img.GetSize().height; ++y)
        {
            for (int x = 0; x < img.GetSize().width; ++x)
            {
                REQUIRE(img.GetPixel({x, y}) == '*');
            }
        }

        REQUIRE(Tile::GetInstanceCount() == 1);
    }

    SECTION("Set and Get Pixel")
    {
        Image img({16, 16}, '.');
        REQUIRE(Tile::GetInstanceCount() == 1);

        img.SetPixel({0, 0}, '#');
        REQUIRE(img.GetPixel({0, 0}) == '#');
        REQUIRE(Tile::GetInstanceCount() == 2);

        img.SetPixel({10, 10}, '@');
        REQUIRE(img.GetPixel({10, 10}) == '@');
        REQUIRE(Tile::GetInstanceCount() == 3);

        img.SetPixel({15, 15}, 'X');
        REQUIRE(img.GetPixel({15, 15}) == 'X');
        REQUIRE(Tile::GetInstanceCount() == 3);
    }

    SECTION("Get Pixel Out of Bounds")
    {
        Image img({16, 16}, '.');

        REQUIRE(img.GetPixel({-1, -1}) == 0xFFFFFF);
        REQUIRE(img.GetPixel({16, 16}) == 0xFFFFFF);
    }

    SECTION("Set Pixel Out of Bounds")
    {
        Image img({16, 16}, '.');

        img.SetPixel({-1, -1}, '#');
        REQUIRE(img.GetPixel({-1, -1}) == 0xFFFFFF);

        img.SetPixel({16, 16}, '#');
        REQUIRE(img.GetPixel({16, 16}) == 0xFFFFFF);
    }

    SECTION("Tile Instance Count")
    {
        {
            Image img1({8, 8}, '*');
            REQUIRE(Tile::GetInstanceCount() == 1);

            Image img2({8, 8}, '#');
            REQUIRE(Tile::GetInstanceCount() == 2);

            img1.SetPixel({0, 0}, '@');
            REQUIRE(Tile::GetInstanceCount() == 2);
            REQUIRE(img1.GetPixel({0, 0}) == '@');
            REQUIRE(img2.GetPixel({0, 0}) != '@');

            img2.SetPixel({0, 0}, '&');
            REQUIRE(Tile::GetInstanceCount() == 2);
            REQUIRE(img2.GetPixel({0, 0}) == '&');
            REQUIRE(img1.GetPixel({0, 0}) != '&');
        }

        REQUIRE(Tile::GetInstanceCount() == 0);
    }
}

TEST_CASE("Tile Tests", "[Tile]")
{
    TestFixture fixture;

    SECTION("Default Constructor")
    {
        Tile tile;

        for (int y = 0; y < Tile::SIZE; ++y)
        {
            for (int x = 0; x < Tile::SIZE; ++x)
            {
                REQUIRE(tile.GetPixel({x, y}) == 0xFFFFFF);
            }
        }

        REQUIRE(Tile::GetInstanceCount() == 1);
    }

    SECTION("Parameterized Constructor")
    {
        Tile tile('*');
        REQUIRE(Tile::GetInstanceCount() == 1);

        for (int y = 0; y < Tile::SIZE; ++y)
        {
            for (int x = 0; x < Tile::SIZE; ++x)
            {
                REQUIRE(tile.GetPixel({x, y}) == '*');
            }
        }
    }

    SECTION("Copy Constructor")
    {
        Tile tile1('*');
        REQUIRE(Tile::GetInstanceCount() == 1);

        Tile tile2(tile1);
        REQUIRE(Tile::GetInstanceCount() == 2);

        for (int y = 0; y < Tile::SIZE; ++y)
        {
            for (int x = 0; x < Tile::SIZE; ++x)
            {
                REQUIRE(tile2.GetPixel({x, y}) == '*');
            }
        }
    }

    SECTION("Set Pixel")
    {
        Tile tile(0xFFFFFF);

        tile.SetPixel({0, 0}, '#');
        REQUIRE(tile.GetPixel({0, 0}) == '#');

        tile.SetPixel({7, 7}, '@');
        REQUIRE(tile.GetPixel({7, 7}) == '@');

        tile.SetPixel({8, 8}, 'X');
        REQUIRE(tile.GetPixel({8, 8}) == 0xFFFFFF);
    }

    SECTION("Get Pixel Out of Bounds")
    {
        Tile tile('*');

        REQUIRE(tile.GetPixel({-1, -1}) == 0xFFFFFF);
        REQUIRE(tile.GetPixel({8, 8}) == 0xFFFFFF);
    }

    SECTION("Destructor Decreases Instance Count")
    {
        {
            Tile tile;
            REQUIRE(Tile::GetInstanceCount() == 1);
        }
        REQUIRE(Tile::GetInstanceCount() == 0);
    }
}
