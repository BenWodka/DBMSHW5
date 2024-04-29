import random

def main():
    for i in range(300):
        j = random.randint(0, 31)
        k = random.randint(0, 31)
        while k == j:
            k = random.randint(0, 31)  # Regenerate k until it's different from j
        l = random.randint(0, 70)
        m = random.randint(0, 70)
        while m == l:
            m = random.randint(0, 70)  # Regenerate m until it's different from l
        n = random.randint(2000, 2024)
        o = random.randint(10, 12)
        p = random.randint(10, 30)
        print(f"({i}, {j}, {k}, {l}, {m}, '{n}-{o}-{p}'),")


if __name__ == '__main__':
    main()