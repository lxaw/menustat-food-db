##################################
#
# Webscraping Images for Foods.
# Written by Lex Whalen (05/23/22)
# MIT License.
# 
# This program loops through the 
# entries in your images folder that
# contain the images of foods and
# creates directories for each restaurant.
# It then puts all the foods from each 
# restaurant into their respective folder.
#
##################################

# for working with files
import os
# for pattern matching
import re
# for file moving
import shutil

def listGetAllFileNamesFromPath(strDirPath):
    # return all file names from path
    return os.listdir(strDirPath)


def voidCreateRestaurantDirs(strSourceDir,strOutDir):
    listFileNames = listGetAllFileNamesFromPath(strSourceDir)
    # strOutDir is the directory 
    # for the files to move to
    pattern = re.compile(r'.*(?=___)')
    # for use in threading
    # get all names of files

    for strName in listFileNames:
        # get the restaurant
        res = re.search(pattern,strName)
        if res!=None:
            strNewDir = strOutDir+ "/"+res.group(0)
            strOldFilePath = strSourceDir + '/'+strName
            strNewFilePath =  strNewDir + '/' + strName
            # enter cs
            # Here if threading you'd need a lock.
            # 
            if not os.path.exists(strNewDir):
                # then create dir
                os.mkdir(strNewDir)
            # regardless, move the
            # file into the directory
            shutil.move(strOldFilePath,strNewFilePath)

if __name__ == "__main__":
    kSOURCE_PATH = 'imgs'
    kOUT_PATH = 'imgs_v2'

    voidCreateRestaurantDirs(kSOURCE_PATH,kOUT_PATH)