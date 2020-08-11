################################################################################
#
# python-fastapi
#
################################################################################

PYTHON_FASTAPI_VERSION = 0.55.1
PYTHON_FASTAPI_SOURCE = fastapi-$(PYTHON_FASTAPI_VERSION).tar.gz
PYTHON_FASTAPI_SITE = https://files.pythonhosted.org/packages/0a/13/785d0e5967128628f1d6c05ba16d4c9bf9506d7fd35bbe5b2e269d2804ab
PYTHON_FASTAPI_SETUP_TYPE = distutils
PYTHON_FASTAPI_LICENSE = MIT
PYTHON_FASTAPI_LICENSE_FILES = LICENSE

$(eval $(python-package))
