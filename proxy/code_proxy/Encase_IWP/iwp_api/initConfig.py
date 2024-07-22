from configparser import ConfigParser, ExtendedInterpolation

def ConfigSectionInit(filePath):
    """Initialization of configuration file based on a file path

    Keyword arguments:
    filePath -- file path that contains initialization    
    """        
    config = ConfigParser(interpolation=ExtendedInterpolation())
    config.read(filePath)
    return config


def ConfigSectionValue(config, section, key): 
    """Retrieve specific value given a section and a key. Values are obtained from a config file

    Keyword arguments:
    config -- Config Section
    section -- Specific section of the config file
    key -- Specific key of a section
    """           
    try:       
        return config[section][key]
    except Exception as e:
        print("exception on section {} with key  {}".format(section,key))    
        
                
def getNullPattern():
    """Returns a null patern that can be used for catching Null in various caps letters"""
    # Pattern Preparation that will evantually identify the word null in a
    # string
    nullStrPatern = '[nN][uU][lL][lL]'
    nullPatern = re.compile(nullStrPatern)
    return nullPatern            
