from math import sin, cos, sqrt, atan2, radians
import mysql.connector
import sys

def get_locations():
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="onlinestore"
    )    

    mycursor = mydb.cursor()

    mycursor.execute("SELECT s_id, s_lat, s_lon FROM seller")

    myresult = mycursor.fetchall()
    locations = []
    for x in myresult:
        locations.append(x)
    return locations


def distance_between_coords(point1, point2):    
    
    # approximate radius of earth in km
    R = 6373.0
    p1, x1, y1 = point1
    p2, x2, y2 = point2
    
    lat1 = radians(52.2296756)
    lon1 = radians(21.0122287)
    lat2 = radians(52.406374)
    lon2 = radians(16.9251681)
    
    dlon = y2 - y1
    dlat = x2 - x1
    
    a = sin(dlat / 2)**2 + cos(x1) * cos(x2) * sin(dlon / 2)**2
    c = 2 * atan2(sqrt(a), sqrt(1 - a))
    
    distance = R * c
    return distance

def closest_point(all_points, new_point):
    best_point = None
    best_distance = None

    for current_point in all_points:
        current_distance = distance_between_coords(new_point, current_point)

        if best_distance is None or current_distance < best_distance:
            best_distance = current_distance
            best_point = current_point

    return best_point


k = 2


def build_kdtree(points, depth=0):
    n = len(points)

    if n <= 0:
        return None

    axis = (depth % k)+1

    sorted_points = sorted(points, key=lambda point: point[axis])

    return {
        'point': sorted_points[n // 2],
        'left': build_kdtree(sorted_points[:n // 2], depth + 1),
        'right': build_kdtree(sorted_points[n // 2 + 1:], depth + 1)
    }


def kdtree_naive_closest_point(root, point, depth=0, best=None):
    if root is None:
        return best

    axis = (depth % k)+1

    next_best = None
    next_branch = None

    if best is None or distance_between_coords(point, best) > distance_between_coords(point, root['point']):
        next_best = root['point']
    else:
        next_best = best

    if point[axis] < root['point'][axis]:
        next_branch = root['left']
    else:
        next_branch = root['right']

    return kdtree_naive_closest_point(next_branch, point, depth + 1, next_best)


def closer_distance(pivot, p1, p2):
    if p1 is None:
        return p2

    if p2 is None:
        return p1

    d1 = distance_between_coords(pivot, p1)
    d2 = distance_between_coords(pivot, p2)

    if d1 < d2:
        return p1
    else:
        return p2


def kdtree_closest_point(root, point, depth=0):
    if root is None:
        return None

    axis = (depth % k)+1

    next_branch = None
    opposite_branch = None

    if point[axis] < root['point'][axis]:
        next_branch = root['left']
        opposite_branch = root['right']
    else:
        next_branch = root['right']
        opposite_branch = root['left']

    best = closer_distance(point,
                           kdtree_closest_point(next_branch,
                                                point,
                                                depth + 1),
                           root['point'])

    if distance_between_coords(point, best) > (point[axis] - root['point'][axis]) ** 2:
        best = closer_distance(point,
                               kdtree_closest_point(opposite_branch,
                                                    point,
                                                    depth + 1),
                               best)

    return best

#print()
locations = get_locations();
#[('delhi',28.6186706,77.1871687),('roorkee',29.8599234,77.8262114),('dehradun',30.3008562,78.0121458),('bangalore',12.974996,77.5364153),('chennai',13.0480438,79.9288015)]
kdtree = build_kdtree(locations)
c_lat = float(sys.argv[1])
c_lon = float(sys.argv[2])
#pivot = ('ghaziyabad',28.648411484674213,77.35680957873757)
pivot = ('xyz',c_lat,c_lon)
found = kdtree_closest_point(kdtree, pivot)
print(found[0])