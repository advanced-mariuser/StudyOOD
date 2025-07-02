#ifndef LAB9_COW_H
#define LAB9_COW_H

#pragma once
#include <cassert>
#include <memory>

template <typename Value>
class CoW
{
    struct WriteProxy
    {
        explicit WriteProxy(Value* value) noexcept
                : value_ptr_{ value }
        {
        }

        //Нельзя скопировать WriteProxy
        WriteProxy(const WriteProxy&) = delete;
        WriteProxy& operator=(const WriteProxy&) = delete;

        //Нельзя использовать с неконстантными ссылками
        Value& operator*() const& = delete;

        [[nodiscard]] Value& operator*() const&& noexcept
        {
            return *value_ptr_;
        }

        //Нельзя использовать с неконстантными ссылками
        Value* operator->() const& = delete;

        Value* operator->() const&& noexcept
        {
            return value_ptr_;
        }

    private:
        Value* value_ptr_;
    };

public:
    // Конструируем значение по умолчанию.
    CoW()
            : value_(std::make_shared<Value>())
    {
    }

    // Создаём значение за счёт перемещения его из value.
    explicit CoW(Value&& value)
            : value_(std::make_shared<Value>(std::move(value)))
    {
    }

    // Создаём значение из value.
    explicit CoW(const Value& value)
            : value_(std::make_shared<Value>(value))
    {
    }

    // Оператор разыменования служит для чтения значения.
    const Value& operator*() const noexcept
    {
        assert(value_);
        return *value_;
    }

    // Оператор -> служит для чтения полей и вызова константных методов.
    const Value* operator->() const noexcept
    {
        assert(value_);
        return value_.get();
    }

    template <typename ModifierFn>
    void Write(ModifierFn&& modify)
    {
        EnsureUnique();

        std::forward<ModifierFn>(modify)(*value_);
    }

    WriteProxy Write() && = delete;

    // eсли объект CoW разделяется между несколькими владельцами (например, если несколько объектов ссылаются на одно и то же значение)
    // то при попытке изменить значение будет создана его копия
    // это позволяет избежать нежелательных изменений в
    // других объектах, которые могут использовать то же самое значение
    [[nodiscard]] WriteProxy Write() &
    {
        EnsureUnique();

        return WriteProxy(value_.get());
    }

    // не обеспечивает защиту от совместного использования
    // это значит, что если несколько объектов ссылаются на одно и то же значение, и один из них вызывает WriteBad
    // то это может привести к непредсказуемым последствиям, т.к. другие объекты могут получить неконсистентное состояние
    Value& WriteBad()
    {
        EnsureUnique();

        return *value_;
    }

private:
    void EnsureUnique()
    {
        assert(value_);

        if (value_.use_count() > 1)
        {
            // Кроме нас на value_ ссылается кто-то ещё, копируем value_.
            value_ = std::make_shared<Value>(*value_);
        }
    }

    std::shared_ptr<Value> value_;
};

#endif //LAB9_COW_H
