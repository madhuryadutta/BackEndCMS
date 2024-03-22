import nltk
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.tag import pos_tag
from nltk.chunk import ne_chunk
from string import punctuation
from collections import Counter
import sys

def extract_keywords(text, num_keywords=50):
    nltk.download('punkt')
    nltk.download('stopwords')
    nltk.download('maxent_ne_chunker')
    nltk.download('words')
    
    # Tokenize the text
    words = word_tokenize(text)

    # Part-of-speech tagging
    tagged_words = pos_tag(words)

    # Named Entity Recognition
    named_entities = ne_chunk(tagged_words)

    # Filter out named entities and stopwords
    stop_words = set(stopwords.words('english'))
    filtered_words = [word for word, pos in tagged_words if pos != 'NNP' and word.lower() not in stop_words
                      and word not in punctuation]

    # Count word frequencies
    word_freq = Counter(filtered_words)

    # Get the top keywords
    top_keywords = word_freq.most_common(num_keywords)

    return [word for word, freq in top_keywords]

try:
    # Input text from command line argument
    text = sys.argv[1]
    
    # Extract keywords
    keywords = extract_keywords(text)

    # Output the keywords as a comma-separated string
    print(','.join(keywords))
except IndexError:
    print("Error: No input text provided")
    sys.exit(1)
except Exception as e:
    print("Error:", e)
    sys.exit(1)