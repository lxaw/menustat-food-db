import os

path = 'imgs'
dirs = os.listdir(path)

count = 0
for dir in dirs:
    dir_path = os.path.join(path,dir)
    count += len(os.listdir(dir_path))

print('total count: {} files'.format(count))