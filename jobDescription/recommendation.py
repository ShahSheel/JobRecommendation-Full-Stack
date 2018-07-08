import psycopg2
import sys
from os import chdir, getcwd, listdir, path
import nltk
from nltk.tokenize import sent_tokenize
from nltk import word_tokenize, pos_tag, ne_chunk
import re
from nltk.stem.wordnet import WordNetLemmatizer
from collections import Counter
from random import randint


user_id = sys.argv[1]
job_search_ID = sys.argv[2]
ID = []
description_list = []
API_URL = []

print("..")
con = psycopg2.connect("host='localhost' dbname='dissertation' user='postgres' password='football10'")
cur = con.cursor()
cur.execute("SELECT id,api,description from job_details where job_search_id = " + str(job_search_ID))


while True:
    row = cur.fetchone()
    
    if(row == None):
        break
    
   
    API_URL.append(row[1]) #Get all the API URLS
    ID.append(row[0])
    description_list.append(row[2])

cur.execute("DELETE FROM job_details where description is null");
con.commit()    
print(ID)
boolDrive = False
GRADE = "<1st|first class|1:1|1.1|2:1|upper second|2:2|2.1|lower second|second|third|3rd>"
cv = "C:\inetpub\wwwroot\jobCvs\cv_"+str(user_id)+".txt" #C:\inetpub\wwwroot\jobCvs\cv_1_1.txt 
with open(cv, 'r') as file:
    data=file.read().replace('\n', '') #Read in file
#data = "HUNTER MORENO 100 Royal Worcester Drive London, England W1T 1JY Mobile: 7700 900129 Tel: (020) 7123 4567 hunter-moreno@email.com PROFESSIONAL SUMMARY Dedicated and dynamic Mathematics Teacher with 10 years experience educating high school level students. Adept in creative lesson planning and real-world-related instruction. Motivational educator with exceptional communication, analytical, and multi-tasking skills. CORE QUALIFICATIONS Learning styles assessment Mathematics expert Classroom management Performance assessments Creative lesson planning Critical and analytical thinking Rubric development Student motivation EXPERIENCE Harrison High School 3/1/2011 to Current Mathematics Teacher London Regularly review, evaluate, analyse, and report on student academic, social, and behavioural progress. Develop, administer, and proctor state mathematics tests. Coordinate with teacher block responsible for curriculum development for 250 students. Meadow Book High School 4/1/2008 to 3/1/2011 Mathematics Teacher London Instituted remedial math programme during lunch hours to help address students needing additional math instruction. Incorporated thought provoking illustrations in classroom decor, which demonstrated math use in daily life. Participated in parent-teacher conferences quarterly to discuss progress and/or reevaluate student goals and instructional approach. London Seniour High School 8/1/2004 to 4/1/2008 Mathematics Teacher London Developed Board of Education approved curriculum and lesson plans or high school age students. Drew on various methodologies in classroom instructions, including: demonstrations, lectures, discussions, and lab experiments. Assessed students’ learning styles in order to cater lesson plans and daily instruction for all learner types. EDUCATION NCL University 2004 Master of Science: Mathematics London, England, USA Licenced Teacher, State of London – 2004"
data = data.encode("ascii", errors="ignore").decode() 
data = data.replace('\t', ' ')
def canDrive(data):
    canDrive = re.search("drivers licence |driving licence",data)
    if (canDrive is None):
        return False
    return True

def highestEducation(data):
    degree = "None"
    isUni = re.search("university",data) #Check if they're in uni / was at uni
    isGrade =  re.search("1st|first class|1:1|2:1|upper second|2:2|lower second|second|third class|3rd class",data)
    #print("Grade: " + str(isGrade))
    education = "GCSE"

    isCollege = re.search("sixth-form|sixth form|A-Levels | O-Levels",data)
    
    if(isCollege is not None):
        education = "A-Levels"
    if(isCollege is not None):
        education = "GCSE"
  
    if(isUni is not None and isGrade is None): #If they they went to university, but never said their grade
        education = "University"
        degree = "Highest Education: " + str(education) + "\nUniversity grade: UNKNOWN"
    
    if(isGrade is not None): #Some Universities do not have the word "university", eg: Imperial College London
        education = "University"
        data = data.replace('1st', 'first class')
        data = data.replace('2:1','upper second class')
        data = data.replace('2:2','second class')
        data = data.replace('2.1','upper second class')
        data = data.replace('2.2','lower second class')
        data = data.replace('2nd class','upper second class')
        data = data.replace('3rd class','lower second class')
        degree = "Highest Education: " + str(education) + "\nUniversity grade: " + str(isGrade)


    #print("Degree " + str(degree) + " For some reaosn it doesn't parse")
    return degree

#Convert CV data to lower case
def removeURLS(data):
    data = re.sub(r'\w+:\/{2}[\d\w-]+(\.[\d\w-]+)*(?:(?:\/[^\s/]*))*', '', data) #Removes all URLS in the CV
    return data

def removeEmail(data):
    emails = re.findall(r'[-a-zA-Z0-9._]+@[-a-zA-Z0-9_]+.[a-zA-Z0-9_.]+',data) #Finds the word "email" and removes it
    #Removes all the emails

    for email in range(0,len(emails)):
        data = data.replace(emails[email],"")
    return data

def removePhone(data):
    
    data = re.sub(r'[a-z]{1,2}[0-9R][0-9a-z]?[0-9][a-z]{2}', '', data) #Removes first postcode it finds
    data = re.sub('(\d+)','',data) #Removes ALL numbers from the CV. This may cause problems for CV's for mathmaticans
    
    return data

def removeSets(data):
    data = re.sub("<.*><phone|cell|mobile|telephone|tel|home|home-phone|email|e-mail|electronic-mail><.*><.*><.*>",'', data)
    data = data.replace('c++','cplusplus')
    data = data.replace('c#','csharp')
    data = re.sub("(^| ).(( ).)*( |$)",' ',data)
    return data


def segmentCV(data):
    return

def tokeniseCV(data):
    tokenise = nltk.word_tokenize(data)
    tokenise = nltk.pos_tag(tokenise)
    
    #print(tokenise)
    stopwords = set()
    for word, pos in tokenise:
        if pos == 'IN':
            stopwords.add(word)
        if pos == 'DT':
            stopwords.add(word)
        if pos == 'PRP':
            stopwords.add(word)
        if pos == 'CC':
            stopwords.add(word)
        if pos == 'IT':
            stopwords.add(word)
        if pos == "PRP$":
            stopwords.add(word)
        if pos == "SYM":
            stopwords.add(word)
        if pos == "TO":
            stopwords.add(word)
        if pos == "RB":
            stopwords.add(word)


    stopwords_2 = ["allow", "s","a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all", "almost", "alone", "along", "already", "also","although","always","am","among", "amongst", "amoungst", "amount", "an", "and", "another", "any","anyhow","anyone","anything","anyway", "anywhere", "are", "around", "as", "at", "back","be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could", "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven","else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely", "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own","part", "per", "perhaps", "please", "put", "rather", "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the"]

    resultwords  = [word for word in re.split('\W+',data) if word.lower() not in stopwords]
    resultwords  = [word for word in re.split('\W+',data) if word.lower() not in stopwords_2]

    
    #print(resultwords)
    
    #Stem 
    verbs = []
    for lem in resultwords:
        verbs.append(WordNetLemmatizer().lemmatize(lem,'v'))
        
    #print(result)
    
    #tf[curr_doc_index] = Counter(resultwords)
    #print(tf[curr_doc_index])
    
    result = ' '.join(verbs)

    result = result.replace('cplusplus','c++') #Converted back to its original base form. 
    result = result.replace('csharp','c#')
    result = result.replace('full stack','full-stack')

    
    return result 


def fixAbbreviations(data):
    return

def removeNamedEntites(data):
    print (ne_chunk(pos_tag(word_tokenize(data))))

    return data

def ToLower(data):
        data = data.lower()
        return data


data = ToLower(data) #Change all casings to lower case
education = highestEducation(data)

drivable = canDrive(data)
data = removeURLS(data) #Remove URLs
data = removeEmail(data) #Remove Email
data = removePhone(data) #Removes phone + postcode
data = removeSets(data) #Remove certain sets 
data = tokeniseCV(data) #Tokenise + removing sets with a pos tag of "IN"
data = "".join(str(x) for x in data)

score = []
match_score = 0

count = -1    

def comparinson(data,description):
    cv_words = set()
    for word in data.split():
        cv_words.add(word)
        
    description_words = set()
    for word in description.split():
        description_words.add(word)

    cases = set(cv_words).intersection(description_words)
    match_score = ((len(cases)) / (len(cv_words) + len(description_words)))*100
    score.append(float(match_score))
    startID = ID[0]
    
    print("count: " + str(count) + "ID is: " + str(ID[count]) + " match score :" + str(score[count]))


#For each description in description[] do
for description in description_list:
    description = ToLower(description) #Change all casings to lower case
    description_education = highestEducation(description)
    description = removeURLS(description) #Remove URLs
    description = removeEmail(description) #Remove Email
    description = removePhone(description) #Removes phone + postcode
    description = removeSets(description) #Remove certain sets 
    description = tokeniseCV(description) #Tokenise + removing sets with a pos tag of "IN"
    description = "".join(str(x) for x in description)
    count = count + 1
    comparinson(data,description) #Obtain the comparinson
#If predict first then score + 0.50
#If predict 2:1 then score + 0.40
#If predict 2:2 then score + 0.30
#If none then score + 0.20


reco_id = []    
def recommendJob(score):

    #score will be 0 - desc length, so i need to simply obtain the highest score from the list, get the index(id) of it, and use that
    #index(id) value to get the value from ID 
    
    if(len(ID) > 10): #If job list > 5 and match is > 1 then get 5 best recommended jobs from list
        first_job = max(score) 
        get_id = score.index(first_job) #Get_id to get the score from the highest similarity job
        temp = ID[get_id]  #use get_id to get the job id from ID and parse it to reco_id array
        reco_id.append(temp)
        score.remove(first_job)
        ID.remove(temp)
        
        second_job = max(score) 
        get_id = score.index(second_job)
        temp = ID[get_id]
        reco_id.append(temp)
        score.remove(second_job)
        ID.remove(temp)

        third_job = max(score) 
        get_id = score.index(third_job)
        temp = ID[get_id]

        reco_id.append(temp)
        score.remove(third_job)
        ID.remove(temp)
        
        fouth_job = max(score) 
        get_id = score.index(fouth_job)
        temp = ID[get_id]
        reco_id.append(temp)
        score.remove(fouth_job)
        ID.remove(temp)

        
        random_job = randint(0,len(ID))
        temp = ID[random_job]
        reco_id.append(temp)

    else:
        first_job = max(score) 
        get_id = score.index(first_job)
        temp = ID[get_id]
        reco_id.append(temp)
        score.remove(first_job)
        ID.remove(temp)

        random_job = randint(0,len(ID))
        temp = ID[random_job]
        reco_id.append(temp)
        

    return reco_id

recommendJob(score)
print(reco_id)
test = []
recommended_url = []
#Use reco_id to get the API URL 
for recommendedurl in reco_id:
    print(recommendedurl)
    cur.execute("SELECT api from job_details where id = %s" % (str(recommendedurl)))
    while True:
        row = cur.fetchone()
        
        if(row == None):
            break
    
   
        recommended_url.append(row[0]) #Get all the API URLS
                
#If user_searches where id = x exists then delete and do this.
cur.execute("DELETE FROM recommendation where user_id = %s" % (str(user_id)));
con.commit()
for url in range(0,len(recommended_url)):
    cur.execute("INSERT INTO  recommendation (user_id, url_id, recommended_job) values ('%s','%s','%s')" % (str(user_id), str(reco_id[url]), str(recommended_url[url])));
    con.commit()

print(recommended_url)
print("Should be [64278,64262,64254,64256] ")
score.clear()
description_list.clear()
ID.clear()

