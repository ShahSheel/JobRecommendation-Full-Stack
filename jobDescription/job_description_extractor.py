from urllib.request import urlopen
from bs4 import BeautifulSoup
import re
import requests
import psycopg2
from os import chdir, getcwd, listdir, path
import time 
import random
from selenium import webdriver
from urllib.parse import urlsplit
from selenium.webdriver.firefox.options import Options
from selenium.webdriver.firefox.firefox_binary import FirefoxBinary
import sys
import traceback
import logging

print("It has called the file")

API_URL=[]
ID = []
new_url = []

job_search_ID = 151;



con = psycopg2.connect("host='localhost' dbname='dissertation' user='postgres' password='football10'")
cur = con.cursor()
cur.execute("SELECT id,api FROM job_details where job_search_id = "  + str(job_search_ID))

while True:
        row = cur.fetchone()
        print("Now in here")
        if row == None:
            break
        
        API_URL.append(row[1]) #Get all the API URLS
        ID.append(row[0])
        #job_search_ID.append(row[1])

print(ID)


count = 0

options = Options()
print("Created Options")
options.add_argument("--headless")
print("Added options")
print("UHM?")
options.binary = "C:\Program Files (x86)\Firefox Nightly\Firefox.exe"

print("Binary set up")

try:
        driver = webdriver.Firefox(firefox_options = options)
except Exception as e:
    logging.error(traceback.format_exc())
print("Running in headless mode")
for i in range(0,len(API_URL)):
        driver.get(API_URL[i])
        print(API_URL[i])
        timer = random.randint(20, 40)
        time.sleep(timer)
        
        final_url = driver.current_url
        print(final_url)
        base_url = "{0.scheme}://{0.netloc}/".format(urlsplit(final_url)) #Check if domain is careerjet
        if(base_url == 'https://www.careerjet.co.uk/'):
                soup = BeautifulSoup(urlopen(final_url),"lxml")
                description =  soup.find(class_="advertise_compact")
                cleantext = re.sub('<[^>]*>', '', str(description))
                description = cleantext.replace("'","''") #Need to add extra apostophie to insert into DB
                print("Scraped: " + base_url  + "with job id: " + str(job_search_ID) + " and id: " + str(ID[i]))
                cur.execute("UPDATE job_details SET description = '%s' WHERE id = '%s' and job_search_id = '%s' " % (str(description), str(ID[i]),str(job_search_ID)))
                con.commit()
                cur.execute("UPDATE job_details SET redirect = '%s' WHERE id = '%s' and job_search_id = '%s' " % (str(final_url), str(ID[i]),str(job_search_ID)))
                con.commit()
                time.sleep(5)
        else:
                if(base_url == "http://jobviewtrack.com/"):
                        soup = BeautifulSoup(urlopen(final_url),"lxml")
                        isBanned =  soup.find('h1')
                        if(isBanned == "<h1>Sorry, this job is no longer available</h1>"):                     
                                print("Domain: " + base_url) #Drop row 
                                print("Expecting http:/www.CareerJet.co.uk")
                                cur.execute("DELETE FROM job_details WHERE id = '%s' AND job_search_id = '%s'" % (str(ID[i]), str(job_search_ID)))
                                con.commit()
                        else:
                                count = count + 1
                                if(count > 10):
                                        print("May have been banned, need to switch ip")
                else:
                         print("Deleting job role.." + base_url)
                         cur.execute("DELETE FROM job_details WHERE id = '%s' AND job_search_id = '%s'" % (str(ID[i]), str(job_search_ID)))
                         con.commit()
                        
                
                                                                                                
driver.quit()

